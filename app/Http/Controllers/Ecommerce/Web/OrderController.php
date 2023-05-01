<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\OrderCommon;
use App\KuHelpers\Helpers;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\CashBackTransaction\CashBackTransaction;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Ecommerce\EcoBvonTransaction;
use App\Model\Ecommerce\EcoEntrepreneurTransaction;
use App\Model\Ecommerce\EcoReserveTransaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\Api\EcoProduct;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    use OrderCommon;

    public function allOrders()
    {

        return view('ecommerce.order.orderlist');
    }
    public function allOrdersDatatables()
    {

        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_products.vendor_id',auth()->user()->id)
            ->select('eco_orders.*')
            ->distinct();
        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    return $order_detail->products->vendor_id == auth()->user()->id;
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                return "<a class='btn btn-alt-primary' href='". route('orders.show', $order->id) ."'>View Details</a>";
            })
            ->make(true);
    }

    public function pendingOrders()
    {
        return view('ecommerce.order.pending-orderlist');
    }
    public function pendingOrdersDatatables()
    {
        $req_path = request()->query('req_path') ?? null;
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_orders.order_status', 'pending');



        if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
            $orders->where('eco_products.vendor_id',auth()->user()->id);
        }

        $orders->select('eco_orders.*')->distinct();
        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
                        return $order_detail->products->vendor_id == auth()->user()->id;
                    } else {
                        return true;
                    }
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('user_info', function($order){
                $user = User::find($order->user_id);
                $output = "<table class='table table-dark'>
                    <tr>
                        <td>Customer Name</td>
                        <td>{$user->name}</td>
                    </tr>
                    <tr>
                        <td>Customer Phone</td>
                        <td>{$user->phone}</td>
                    </tr>
                <table>";
                return $output;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                if(auth()->user()->hasRole('vendor')) {
                    $route = route('orders.show', $order->id);
                } else {
                    $route = route('orders.admin.show', $order->id);
                }
                return "<a class='btn btn-alt-primary' href='". $route ."'>View Details</a>";
            })
            ->rawColumns(['user_info', 'action'])
            ->make(true);
    }

    public function cancelOrders()
    {
        return view('ecommerce.order.cancel-orderlist');
    }
    public function cancelOrdersDatatables()
    {
        $req_path = request()->query('req_path') ?? null;
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_orders.order_status', 'cancel');
        if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
            $orders->where('eco_products.vendor_id',auth()->user()->id);
        }
        $orders->select('eco_orders.*')->distinct();
        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    return $order_detail->products->vendor_id == auth()->user()->id;
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                if(auth()->user()->hasRole('vendor')) {
                    $route = route('orders.show', $order->id);
                } else {
                    $route = route('orders.admin.show', $order->id);
                }
                return "<a class='btn btn-alt-primary' href='". $route ."'>View Details</a>";
            })
            ->make(true);
    }

    public function completeOrders()
    {
        return view('ecommerce.order.complete-orderlist');
    }
    public function completeOrdersDatatables()
    {
        $req_path = request()->query('req_path') ?? null;
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_orders.order_status', 'complete');
            if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
                $orders->where('eco_products.vendor_id',auth()->user()->id);
            }
            $orders->select('eco_orders.*')->distinct();


        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    return $order_detail->products->vendor_id == auth()->user()->id;
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                if(auth()->user()->hasRole('vendor')) {
                    $route = route('orders.show', $order->id);
                } else {
                    $route = route('orders.admin.show', $order->id);
                }
                return "<a class='btn btn-alt-primary' href='". $route ."'>View Details</a>";
            })
            ->make(true);
    }

    public function processingOrders()
    {
        return view('ecommerce.order.processing-orderlist');
    }
    public function processingOrdersDatatables()
    {
        $req_path = request()->query('req_path') ?? null;
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_orders.order_status', 'processing');

            if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
                $orders->where('eco_products.vendor_id',auth()->user()->id);
            }
            $orders->select('eco_orders.*')->distinct();
        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    return $order_detail->products->vendor_id == auth()->user()->id;
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                if(auth()->user()->hasRole('vendor')) {
                    $route = route('orders.show', $order->id);
                } else {
                    $route = route('orders.admin.show', $order->id);
                }
                return "<a class='btn btn-alt-primary' href='". $route ."'>View Details</a>";
            })
            ->make(true);
    }

    public function shippedOrders()
    {
        return view('ecommerce.order.shipped-orderlist');
    }
    public function shippedOrdersDatatables()
    {
        $req_path = request()->query('req_path') ?? null;
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->where('eco_orders.order_status', 'shipped');
        if( !auth()->user()->hasRole('administrator') && !strpos($req_path, "admin")) {
            $orders->where('eco_products.vendor_id',auth()->user()->id);
        }
        $orders->select('eco_orders.*')->distinct();
        return Datatables::of($orders)
            ->addColumn('total_order', function($order){
                $order_details = EcoOrderDetail::where("order_id", $order->id)->get();
                $total_order = $order_details->filter(function($order_detail){
                    return $order_detail->products->vendor_id == auth()->user()->id;
                })->map(function($order_detail){
                    return $order_detail->product_price * $order_detail->product_quantity;
                })->sum();
                return $total_order;
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($order){
                if(auth()->user()->hasRole('vendor')) {
                    $route = route('orders.show', $order->id);
                } else {
                    $route = route('orders.admin.show', $order->id);
                }
                return "<a class='btn btn-alt-primary' href='". $route ."'>View Details</a>";
            })
            ->make(true);
    }

    public function allAdminOrders()
    {
        return view('ecommerce.order.admin-orderlist');
    }
    public function allAdminOrdersDatatables()
    {
        $orders =  EcoOrder::all();
        return Datatables::of($orders)
            ->addColumn('action', function($order){
                return "<a class='btn btn-alt-primary' href='". route('orders.admin.show', $order->id) ."'>View Details</a>";
            })
            ->addColumn('created_at', function($order){
                return $order->created_at ? with(new Carbon($order->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->make(true);
    }

    public function OrderDetails($id)
    {
        $orders =  DB::table('eco_orders')
            ->join('eco_order_details', 'eco_orders.id', '=', 'eco_order_details.order_id')
            ->join('eco_products', 'eco_order_details.product_id', '=', 'eco_products.id')
            ->join('users', 'eco_orders.user_id', '=', 'users.id' )
            ->where('eco_orders.id','=', $id)
            ->where('eco_products.vendor_id',auth()->user()->id)
            ->select('eco_orders.address', 'eco_orders.order_serial', 'eco_order_details.*', 'eco_products.product_name', 'eco_products.product_quantity as stock', 'users.name as user_name');
            return view('ecommerce.order.order_details')->with(["order_details" => $orders->get()]);
    }



    public function adminOrderDetails($id)
    {
        return view('ecommerce.order.admin-order_details')->with(["order" => EcoOrder::find($id)]);
    }



    public function orderComplete(EcoOrder $order_id)
    {
        DB::beginTransaction();

        if($order_id->order_status == 'cancel' || $order_id->order_status == 'complete') return back()->with(["error" => "Order already cancel or completed"]);

        // order user referred by id
        $has_referred_by = $order_id->user->referred_by != NULL;







        // order details with products
        $order_details = $order_id->manyOrders()->with('products')->get();



        /// full order summary
        $full_order_summary = [];






        // check this is the first order by the order user
        $first_order = EcoOrder::where('user_id', $order_id->user_id)->where('order_status', 'complete')->count() === 0;











        // give registration bonus
        if($order_id->is_default === 0) {
            $user_registration_time = $order_id->user->created_at;
            $order_time = $order_id->created_at;
            $order_time_diff = $user_registration_time->diffInMinutes($order_time);
            $registration_time_limit = json_decode(AdminSetting::getSetting("User Registration Bonus Time Limit"), true);
            $registration_minimum_order_amount = AdminSetting::getSetting("User Registration Bonus Minimum Order Amount");
            $order_time_limit = Helpers::hourMinuteToMinute($registration_time_limit["H"], $registration_time_limit["M"]);
            if($first_order && $order_time_diff <= $order_time_limit && $order_id->order_amount >= $registration_minimum_order_amount) {
                $referral_user = User::validateReferralId($order_id->user->referred_by);
                if($referral_user) {
                    Helpers::giveRegistrationBonus($referral_user);
                }
            }
        }



        foreach ($order_details as $detail) { //each product foreach start



            // single product in order details
            $product = $detail->products;





            $single_product_price_distribution_summary = [
                "product_{$product->id}" => []
            ];

            // validate product sr amount
            $sr_amount_array = Helpers::validateCommaSeperatedNumericString($product->sr_amount, 'array');

            // total amount array sum
            $sr_amount_array_sum = collect($sr_amount_array)->sum();


            $entrepreneur_amount = ($product->bvon_price - $product->production_price) * $detail->product_quantity;
            $bvon_amount = $product->production_price * $detail->product_quantity;
            $store_amount = $product->store_amount * $detail->product_quantity;
            $reserve_amount = (($product->premium_price - ($sr_amount_array_sum + $product->store_amount)) - $product->bvon_price) * $detail->product_quantity;
            $sr_amount_given = false;
            $store_amount_given = false;


            // give bvon amount
            if($bvon_amount != 0) {
                $eco_bvon_transaction = EcoBvonTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $bvon_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["bvon_amout_given"] = [
                    "id" => $eco_bvon_transaction->id,
                    "amount" => $eco_bvon_transaction->amount,
                ];
            }

            // give entrepreneur amount
            if($entrepreneur_amount != 0) {
                $eco_entrepreneur_transaction = EcoEntrepreneurTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $entrepreneur_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["entrepreneur_amout_given"] = [
                    "transaction_id" => $eco_entrepreneur_transaction->id,
                    "amount" => $eco_entrepreneur_transaction->amount
                ];
            }



            // give SR amount
            if($has_referred_by && count($sr_amount_array) > 0) {
                if(count($sr_amount_array) == 1 && $sr_amount_array[0] == 0) {} else {
                    $given_sr_amount = $this->giveSrAmount($sr_amount_array, $order_id, $detail);
                    $single_product_price_distribution_summary["product_{$detail->products->id}"]["sr_amout_given"] = $given_sr_amount;
                    $sr_amount_given = true;
                }
            }

            // INFO: Give store amount whene there is a store

            // give reserve amount
            $total_amount_have_to_give_to_sr = 0;
            for($i = 0; $i < count($sr_amount_array); $i++) {
                if($i == 0) {
                    $total_amount_have_to_give_to_sr += ($sr_amount_array[$i] + $detail->product_price - $detail->products->premium_price) * $detail->product_quantity;
                } else {
                    $total_amount_have_to_give_to_sr += $sr_amount_array[$i] * $detail->product_quantity;
                }
            }

            if(!$sr_amount_given && gettype($sr_amount_array) == "array") {
                $reserve_amount += $total_amount_have_to_give_to_sr;
            } else {
                if($given_sr_amount["sr_amount_total_given"] < $total_amount_have_to_give_to_sr) {
                    $reserve_amount += $total_amount_have_to_give_to_sr - $given_sr_amount["sr_amount_total_given"];
                }
            }
            if(!$store_amount_given) $reserve_amount += $store_amount;
            if($reserve_amount != 0) {
                $eco_reserve_transaction = EcoReserveTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $reserve_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["reserve_amout_given"] = [
                        "transaction_id" => $eco_reserve_transaction->id,
                        "amount" => $eco_reserve_transaction->amount
                ];

            }



            /*
                disable first order cashback and now cashback bonus has been given to all
                $first_order = EcoOrder::where('user_id', $order_id->user_id)->where('order_status', 'complete')->count() === 0;

                info:: to enable first order replace the if section in give cashback comment below
                        code --> if($first_order && $slider = $detail->products->product_under_slider()) {
            */
            // give cashback
            if(!$first_order) {
                if($slider = $detail->products->product_under_slider()) {
                    $product_cashback_amount = (($detail->product_price * (int)$slider->percentage) / 100) * $detail->product_quantity;
                    $cashback_transaction = CashBackTransaction::create([
                        "user_id" => $order_id->user_id,
                        "product_id" => $detail->product_id,
                        "order_id" => $detail->order_id,
                        "product_name" => "",
                        "type" => "c",
                        "amount" => $product_cashback_amount,
                        "message" => "Congratulations! Cashback amount credited for {$product->product_name} purchase"
                    ]);
                    $single_product_price_distribution_summary["product_{$product->id}"]["cashback_amout_given"] = [
                        "transaction_id" => $cashback_transaction->id,
                        "amount" => $cashback_transaction->amount
                    ];
                }

            }

            // update product quantity
            $updated_quantity = $product->product_quantity - $detail->product_quantity;
            $detail->products()->update([
               "product_quantity" => $updated_quantity
            ]);
            $full_order_summary["order_given"][] = $single_product_price_distribution_summary;

        } //each product foreach end





        // Give First order cashback
        $first_order_percentage = (double) AdminSetting::getSetting('First Order Cashback Percentage');
        if($first_order && $first_order_percentage > 0) {
            $first_order_cashback_amount = ($order_id->order_amount * $first_order_percentage)/100;
            $cashback_transaction = CashBackTransaction::create([
                "user_id" => $order_id->user_id,
                "order_id" => $order_id->id,
                "type" => "c",
                "amount" => round($first_order_cashback_amount, 2),
                "message" => "Congratulations for first order! Cashback amount credited for order serial {$order_id->order_serial}"
            ]);

            $full_order_summary["order_given"]["first_order_cashback"] = [
                "transaction_id" => $cashback_transaction->id,
                "amount" => $cashback_transaction->amount
            ];
        }


        // payment taken
        $payments = $order_id->payments()->where(function($q){
            return $q->where('order_type', '=', 'Cashback')->orWhere('order_type', '=', 'E-wallet');
        });
        if($payments->count() > 0) {
            $payment_taken = [];
            foreach ($payments->get() as $payment) {
                if($payment->order_type == 'Cashback') {
                    $cashback_transaction_taken = CashBackTransaction::create([
                        "user_id" => $order_id->user_id,
                        "order_id" => $payment->order_id,
                        "product_name" => "",
                        "type" => "d",
                        "amount" => $payment->amount,
                        "message" => "Cashback amount debited for Order No: #{$order_id->order_serial}"
                    ]);

                    $payment_taken["cashback"] = [
                        "transaction_id" => $cashback_transaction_taken->id,
                        "amount" => $cashback_transaction_taken->amount
                    ];
                }
                else if($payment->order_type == 'E-wallet') {
                    $user_transaction_taken = $order_id->user->transactions()->create([
                        "category" => "product_purchase",
                        "amount_type" => "d",
                        "amount" => $payment->amount,
                        "data" => json_encode([
                            "order_id" => $payment->order_id,
                        ]),
                        "message" => ucfirst("E-wallet balance used for order no: {$order_id->order_serial}")
                    ]);
                    $payment_taken["e-walet"] = [
                        "transaction_id" => $user_transaction_taken->id,
                        "amount" => $user_transaction_taken->amount
                    ];
                }

            }

            $full_order_summary["order_taken"][] = $payment_taken;
        }





        $order_complete = $order_id->update([
           'order_status' => 'complete',
           'payment_status' => 'paid',
           'complete_order_detail' => json_encode($full_order_summary)
        ]);
        if($order_complete) {
            DB::commit();
            return back()->with(['success' => 'Order Complete Successful']);
        }
    }









    protected function giveSrAmount($sr_amount_array, $order_id, $detail) {
        $sr_amount_collection = collect($sr_amount_array);
        $sr_tree_upper = collect([]);
        for($i = 0; $i < $sr_amount_collection->count(); $i++) {
            $sr_user = false;
            if($sr_tree_upper->count() < 1) {
                if($order_id->is_default === 1 && $order_id->user->has_job()) {
                    $sr_user = $order_id->user;
                } else {
                    $sr_user = User::validateReferralId($order_id->user->referred_by);
                }
            } else {
                if($sr_tree_upper->last()->has_job()) {
                    $sr_user = User::validateReferralId($sr_tree_upper->last()->referred_by);
                } else {
                    $sr_user = false;
                }
            }

            if($sr_user) $sr_tree_upper->push($sr_user);
            else break;
        }

        $sr_amount_given = [];
        $sr_total_given_amount = 0;

        for($i = 0; $i < $sr_tree_upper->count(); $i++) {
            if($i == 0) {
                $sr_amount = ($sr_amount_collection[$i] + ($detail->product_price - $detail->products->premium_price)) * $detail->product_quantity;
            } else {
                $sr_amount = $sr_amount_collection[$i] * $detail->product_quantity;
            }

            $sr_user_give_amount = $sr_tree_upper[$i]->transactions()->create([
                "category" => "product_purchase_bonus",
                "amount_type" => "c",
                "amount" => $sr_amount,
                "data" => json_encode([
                    "order_id" => $detail->order_id,
                    "order_details_id" => $detail->id,
                    "product_id" => $detail->product_id,
                ]),
                "message" => ucfirst("you have got product purchase bonus from {$detail->products->product_name}")
            ]);

            $sr_total_given_amount += $sr_user_give_amount->amount;

            if($sr_user_give_amount) {
                $sr_amount_given["sr_amount_given_to_user"][] = [
                    "user_id" => $sr_user_give_amount->user_id,
                    "amount" => $sr_user_give_amount->amount
                ];
            }

        }
        $sr_amount_given["sr_amount_total_given"] = $sr_total_given_amount;
        return $sr_amount_given;
    }











    public function orderToProduct($id)
    {
         $ordersDetails = EcoProduct::find($id)->orderToProduct;
         foreach ($ordersDetails as $key => $value) {
             EcoProduct::find($value->product_id)->decrement('product_quantity',$value->product_quantity);
         }
    }
    public function delivery()
    {
        $orders = EcoOrder::where('order_status',3)->get();
        return view('ecommerce.order.delivery',compact('orders'));
    }
    public function cancel()
    {
        $orders = EcoOrder::where('order_status',2)->get();
        return view('ecommerce.order.cancel',compact('orders'));
    }
    public function weeklyReport()
    {
        return EcoOrder::orderWeeklyReport();
    }
    public function dateRangeRport(Request $request)
    {
        $start_date = $request->query('start_date') ?? null;
        $end_date = $request->query('end_date') ?? null;
        return EcoOrder::orderDateRangeReport($start_date, $end_date);
    }



}
