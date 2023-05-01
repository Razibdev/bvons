<?php

namespace App\Http\Controllers\Ecommerce\Api;


use App\Exceptions\ProductExceptions;
use App\Http\Controllers\Controller;
use App\Http\Resources\EcoOrderCollection;
use App\Model\Ecommerce\Api\EcoAddress;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoSlider;
use App\Model\Ecommerce\EcoSliderDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function add(Request $request)
    {


        $user_is_verified = auth()->user()->check_user_is_verified();

        if(auth()->user()->has_job() && $request->is_default == 1) {
            $user_is_verified = false;
        }


        // validate request data
        $request->validate([
           "order_amount" => "required|numeric",
           "address_id" => "required",
           "payments.Cashback" => "numeric",
           "payments.E-wallet" => "numeric",
           "payments.CashOnDelivery" => "numeric",
           "product_details_list" => "required | array",
           "product_details_list.*.product_quantity" => "numeric",
           "product_details_list.*.product_price" => "numeric",
        ]);


        $product_detail_list = $request->product_details_list;

        /*
            1. Check all product id -> product price(user type wise) with given product price. If matched then continue else return error.
            9. Validate total payables (Sum of All product prices of database from step 1) == (requested e-wallet balance use + cashback wallet balance use + bKash payment + cash on delivery). If mathed continue, else return error.
        */
        try {
            $total_product_price = 0;
            $total_request_price = 0;
            foreach ($request->product_details_list as $product_details) {
                $db_price = EcoProduct::find($product_details["product_id"])->{$user_is_verified ? "premium_price" : "user_price"};
                $total_product_price += $db_price * $product_details["product_quantity"];
                if($db_price != $product_details["product_price"]) {
                    throw new ProductExceptions([
                        "message"       => 'product price missmatch',
                        "code"          =>  1,
                        "meta-data"     => [
                            "product_id"    => $product_details["product_id"],
                            "given_price"   => $product_details["product_price"],
                            "db_price"      => $db_price,
                        ],
                    ]);
                }
            }

            foreach ($request->payments as $payment_key => $payment_value) {
                $total_request_price += $payment_value;
            }
            if((double) $total_product_price !== (double) $total_request_price || (double) $request->order_amount !== (double) $total_product_price) {
                throw new ProductExceptions([
                    "message"                   => 'invalid total price',
                    "code"                      =>  3,
                    "meta-data"                 => [
                        "db_price"              => $total_product_price,
                        "total_request_price"   => $total_request_price,
                        "order_amount"          => $request->order_amount,
                    ],
                ]);
            }
        } catch (ProductExceptions $pe) { return $pe; }

        /*
            3. Check users Cash-back wallet balance - pending Cash-back wallet balance used. If the requested Cash-back amount is valid then continue else return error.
            4. Check if each product is valid for cashback use or not. Get valid products and continue.
            5. All the products here should be valid for cashback use. Now check if the user is premium or not get the product prices accordingly.
            6. Check the usable cash-back percentage from settings.
            7. Calculate total usable cash-back (Product Price{user type wise}*percentage%*product_quantity) for each product and add them all.
            8. Validate requested cashback use <= calculated usable cash-back(from step 6). If false return error, else continue.
        */


        if($request->filled('payments.Cashback') && $request->is_default !== 1) {
            $product_not_under_campain = [];
            foreach ($product_detail_list as $product) {
                $campain = EcoSliderDetail::where('product_id', $product["product_id"]);
                if($campain->count() === 0) {
                    $product_not_under_campain[] = $product;
                } else{
                    $sliderStatus = EcoSlider::where('id', '=', $campain->first()->slider_id)->first()->sliders_status === 0;
                    if($sliderStatus) {
                        $product_not_under_campain[] = $product;
                    }
                }
            }
            $totalCashbackCanBeUsed = 0;
            foreach ($product_not_under_campain as $price) {
                $useable_cashback_percent = EcoProduct::find($price["product_id"])->can_use_cashback;
                $cashback = ($price["product_price"] * ($useable_cashback_percent/100)) * $price["product_quantity"];
                $totalCashbackCanBeUsed += $cashback;
            }
            $user_cashback_remaining_balance = auth()->user()->cashbackBlance() - auth()->user()->cashbackPendingBlance();
            try{
                if($request["payments.Cashback"] <= $user_cashback_remaining_balance &&  $request["payments.Cashback"] <= $totalCashbackCanBeUsed) {

                } else {
                    throw new ProductExceptions([
                        "message"       => 'product cashback price problem',
                        "code"          =>  2,
                        "meta-data"     => [
                            "user_cashback_blance"                  => auth()->user()->cashbackBlance(),
                            "user_cashback_pending_blance"          => auth()->user()->cashbackPendingBlance(),
                            "user_cashback_remaining_blance"        => $user_cashback_remaining_balance,
                            "request_cashback"                      => $request["payments.Cashback"],
                            "can_use_cashback"                      => $totalCashbackCanBeUsed,
                        ],
                    ]);
                }
            } catch (ProductExceptions $pe) { return $pe; }
        }

        /*
            3. Check users Cash-back wallet balance - pending Cash-back wallet balance used. If the requested Cash-back amount is valid  then continue else return error.
        */
        if($request->filled('payments.E-wallet')) {
            try {
                if(
                    auth()->user()->pendingBalance() === 0 ||
                    $request["payments.E-wallet"] > auth()->user()->balance() ||
                    auth()->user()->hasEwaletPendingWithdrawal() ||
                    auth()->user()->hasEwaletPendingRequestInOrdersPayment()) {
                    throw new ProductExceptions([
                        "message"       => 'E-wallet balance error',
                        "code"          =>  4,
                        "meta-data"     => [
                            "user_withdrawl_request_amount"         => auth()->user()->pendingBalance(),
                            "user_order_payment_request_amount"     => auth()->user()->eWalletPendingAmountInOrdersPayment(),
                        ],
                    ]);
                }
            } catch (ProductExceptions $pe) { return $pe; }
        }
        $address = EcoAddress::find($request->address_id);
        if(!$address) {
            try {
                throw new ProductExceptions([
                        "message"       => 'Address not found',
                        "code"          =>  5,
                        "meta-data"     => [
                        "address_id"    => $request->address_id,
                    ],
                ]);
            } catch (ProductExceptions $pe) { return $pe; }
        }
        $order = EcoOrder::create([
            'order_amount' => $request->order_amount,
            'user_id' => auth()->id(),
            'order_serial' => "",
            'is_default' => $request->is_default === 1 ? 1 : 0,
            'address' => json_encode(EcoAddress::find($request->address_id)),
        ]);
        $order->order_serial = "bVon-" . Carbon::now()->format('dmy') . $order->id;
        $order->assign_bdealer_id = $this->assign_order_to_bdealer($order);

        $order->save();

        foreach ($product_detail_list as $product_detail) {
            $order->manyOrders()->create([
                "product_price" => $product_detail["product_price"],
                "product_quantity" => $product_detail["product_quantity"],
                "color" => $product_detail["color"] ?? null,
                "size" => $product_detail["size"] ?? null,
                "product_id" => $product_detail["product_id"]
            ]);
        }
        foreach ($request->payments as $payment_key => $payment_value) {
            $order->payments()->create([
                "order_type" => $payment_key,
                "amount" => $payment_value,
                "transaction_id" => $request->has("transaction_id." . $payment_key) ? $request["transaction_id." . $payment_key] : null,
            ]);
        }
        return response()->json(["data" => ["order" => $order]], 200);
    }

    private function assign_order_to_bdealer($order)
    {
        if($refferd_by_user = User::validateReferralId($order->user->referred_by)) {
            if($refferd_by_user->has_job()) {
                $refferd_by_user_job = $refferd_by_user->job;
                if($refferd_by_user_job->area_type === "App\Model\Area\Village") {
                    $village = $refferd_by_user_job->areaable;
                    if($sub_bdealer_found = $village->bdealer()->where('bdealer_type_id', 4)->active()->get()->first()) {
                        return $sub_bdealer_found->id;
                    } else {
                        $thana = $village->thana;
                        if($bdealer = $thana->bdealer()->where('bdealer_type_id', 3)->active()->get()->first()){
                            return $bdealer->id;
                        } else {
                            return null;
                        }
                    }
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }


        return null;
    }

    public function getOrders()
    {
        $order_status = request()->query('order_status') ?? null;
        $order_serial = request()->query('order_serial') ?? null;
        $order = null;

        if($order_status) {
            $order = auth()->user()->orders()->where('order_status', $order_status);
        }

        if($order_serial) {
            $order = auth()->user()->orders()->where('order_serial', $order_serial);
        }
        if($order !== null) return $order->latest()->paginate(100);
        if($order === null) return auth()->user()->orders()->latest()->paginate(100);
    }

    public function getOrderDetails($id)
    {
        $orders = EcoOrder::where('id', $id);
        $is_bdealer = auth()->user()->b_dealer ? true : false;
        if($orders->count()) {
            if(auth()->id() === $orders->first()->user->id) {
                return new EcoOrderCollection($orders->first());
            } else if($is_bdealer && auth()->user()->b_dealer->id === $orders->first()->assign_bdealer_id) {
                return new EcoOrderCollection($orders->first());
            } else {
                return response()->json(["error" => "cannot access this order"], 422);
            }
        }
        return response()->json(["error" => "invalid order id"], 422);
    }

    public function cancelOrder(EcoOrder $order)
    {
        if(auth()->id() !== $order->user->id) return response()->json(["error" => "access denied"], 433);
        if($order->order_status === 'pending') {
            $updated = $order->update([
                'order_status' => 'cancel'
            ]);
            if($updated) {
                return response()->json(['message' => "Your order {$order->order_serial} has been cancelled"]);
            }
        }

        return response()->json(['error' => "Your order can not be cancelled"], 433);

    }

}
