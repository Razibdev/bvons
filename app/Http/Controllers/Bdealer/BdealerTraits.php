<?php

namespace App\Http\Controllers\Bdealer;
use App\Admin;
use App\Http\Controllers\Ecommerce\OrderCommon;
use App\Http\Requests\BdealerOrderAddRequest;
use App\Http\Resources\BdealerOrderCollection;
use App\Http\Resources\BdealerOrderDetailsCollection;
use App\KuHelpers\Helpers;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerOrder;
use App\Model\Bdealer\BdealerOrderDetail;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Bdealer\BdealerTransaction;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Notifications\BdealerOrderForward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait BdealerTraits
{
    use OrderCommon;
    public function orderAddApi(BdealerOrderAddRequest $request)
    {
        $bdealerOrder = DB::transaction(function() use ($request){
            $b_order = BdealerOrder::create([
                "bdealer_id"        => auth()->user()->b_dealer->id,
                "status"            => "pending",
                "assigned_to"       => auth()->user()->b_dealer->bdealer_id,
                "serial"            => "",
                "pin"               => Str::random(6),
                "amount"            => 0,
                "seen_status"       => 0,
                "delivery_address"  => $request->address,
            ]);
            $totalAmount = 0;

            foreach ($request->data as $product) {
                $product_details = EcoProduct::where("id", $product["product_id"])->with('media')->first();
                $totalQuantity = collect($product["specification"])->pluck('quantity')->sum();
                $product_json = [
                    "product_details" => $product_details,
                    "order_details" => $product,
                ];
                BdealerOrderDetail::create([
                    "bdealer_order_id" => $b_order->id,
                    "product_json" => json_encode($product_json),
                    "quantity" => $totalQuantity,
                ]);
                $totalAmount += $product["price"] * $totalQuantity;
            }

            $b_order->serial = "bVon-D-" . Carbon::now()->format('dmy') . $b_order->id;
            $b_order->amount = $totalAmount;
            $b_order->save();


            BdealerTransaction::create([
                "bdealer_id" => auth()->user()->b_dealer->id,
                "bdealer_transaction_category_id" => 2,
                "type" => "d",
                "amount" => $totalAmount,
                "message" => "B-Dealer wallet has been debited for Order Serial: {$b_order->serial}",
                "data" => json_encode($b_order),
            ]);

            return $b_order;
        });

        if($bdealerOrder->assigned_to) {
            $fcm_token = Bdealer::find($bdealerOrder->assigned_to)->user->fcm_token;
            if($fcm_token) {
                Helpers::send_push_notification([
                    "fcm_token" => $fcm_token,
                    "title" => "B-Dealer order received",
                    "body" => "A new order has been placed by " . auth()->user()->name,
                ]);
            }
        }
        return new BdealerOrderCollection($bdealerOrder);
    }
    public function orderDetailsApi(BdealerOrder $border)
    {
        $validator = Validator::make([], []);
        $is_bdealer_order = $border->bdealer_id  !== auth()->user()->b_dealer->id;
        $is_bdealer_assign_order = $border->assigned_to  !== auth()->user()->b_dealer->id;
        if($is_bdealer_order && $is_bdealer_assign_order) return $validator->errors()->add("invalid_user", "You doesn't have permission to view this orders");
        return new BdealerOrderDetailsCollection($border);
    }
    public function myOrdersApi(Request $request)
    {
        $b_orders = auth()->user()->b_dealer->orders()->where('status', $request->query('status'))->orderBy('created_at', 'desc')->paginate(20);
        return BdealerOrderCollection::collection($b_orders);
    }
    public function assignOrderApi(Request $request)
    {
        $b_orders = auth()->user()->b_dealer->my_assign_orders()->where('status', $request->query('status'))->orderBy('created_at', 'desc')->paginate(20);
        return BdealerOrderCollection::collection($b_orders);
    }
    public function forwardOrderApi($border_id)
    {
        $border = BdealerOrder::where('id', $border_id);
        if($border->count() < 1) return response()->json(["error"=> "invalid order id"], 422);
        $border = $border->first();
        $order_bdealer_id = $border->assigned_to;
        $bdealer_id = auth()->user()->b_dealer->id;

        if($order_bdealer_id != $bdealer_id) return response()->json(["error"=> "order doesn't belongs to this users"], 422);
        if($border->status === 'complete' || $border->status === 'cancel') return response()->json(["error"=> "cannot forward this order"], 422);


        $updated = $border->update([
           "assigned_to" => NULL
        ]);

        if($updated) {
            $admin = Admin::find(1);
            Notification::send($admin, new BdealerOrderForward($border));
            return $updated;
        }
    }
    public function customerOrdersApi(Request $request)
    {
        $status = $request->query('status') ?? 'pending';
        $bdealer = auth()->user()->b_dealer;
        return $bdealer->eco_orders()->where('order_status', $status)->orderBy('created_at', 'desc')->paginate(20);
    }
    public function changeStatusApi(Request $request)
    {

        $request->validate([
           "order_id"   => ["required", "integer"],
           "status"     => ["required"]
        ]);
        $b_orders = auth()->user()->b_dealer->my_assign_orders()->where('id', $request->order_id);

        if($b_orders->count()) {
            $dbStatusId = $this->getStatusId($b_orders->first()->status);
            $reqStatusId = $this->getStatusId($request->status);
            if($reqStatusId === 0) return response()->json(["error" => "Invalid status"]);
            if($dbStatusId === $reqStatusId) return response()->json(["error" => "Status already: {$b_orders->first()->status}"]);
            if(in_array($dbStatusId, [4,5])) return response()->json(["error" => "Cannot change status"]);
            if($dbStatusId > $reqStatusId) return response()->json(["error" => "Status cannot be reversed"]);

            $bdealer_order_updated = ["status" => false, "message" => "Something wrong"];

            if($reqStatusId === 4) {
                $bdealer_order_updated = $this->cancelBdealerOrder($b_orders, $request);
            } else if($reqStatusId === 5) {
                $bdealer_order_updated = $this->completBdealerOrder($b_orders, $request);
            } else {
                $orderUpdated = $b_orders->update([
                    "status" => $request->status
                ]);
                if($orderUpdated) {
                    $bdealer_order_updated = ["status" => true, "message" => "You order {$b_orders->first()->serial} has been {$b_orders->first()->status}"];
                }
            }


            if($bdealer_order_updated["status"]) {
                $fcm_token = $b_orders->first()->user()->fcm_token;
                if($fcm_token) {
                    $notification = Helpers::send_push_notification([
                        "fcm_token" => $fcm_token,
                        "title" => "B-Dealer order update",
                        "body" => "You order {$b_orders->first()->serial} has been {$b_orders->first()->status}"
                    ]);
                }
            }
            return $bdealer_order_updated;

        } else {
            return response()->json(["status" => false, "message" => "Something wrong"], 422);
        }
    }
    private function cancelBdealerOrder($b_order, $request) {
        return DB::transaction(function() use ($b_order, $request){
            $updated = $b_order->update([
                "status" => $request->status
            ]);
            $created = $b_order->first()->bdealer->transactions()->create([
                "bdealer_transaction_category_id" => 4,
                "type" => "c",
                "amount" => $b_order->first()->amount,
                "data" => json_encode($b_order->first()),
                "message" => "Amount refunded for order cancellation. Order Serial: {$b_order->first()->serial}",
            ]);
            if($updated && $created) return ["status" => true, "message" => "Cancellation successful"];
            return ["status" => false, "message" => "Cancellation is not possible at this moment"];
        });
    }
    private function completBdealerOrder($b_order, $request) {
        // complete error check
        $border = $b_order->first();
        $errors = [
            "status" => true,
            "message" => "",
        ];
        $stocks = [];
        $order_details = $border->border_details->map(function($order_detail){
            $product_json = $order_detail->product_json = json_decode($order_detail->product_json);
            return $order_detail;
        });
        if($border->pin !== $request->pin) {
            $errors["status"] = false;
            $errors["message"] = "Invalid PIN";
            return $errors;
        }
        foreach ($order_details as $order_detail) {
            $product_id = $order_detail->product_json->product_details->id;
            $stock = BdealerProductStock::stock($product_id, $border->assigned_to);
            $stocks[] = [
                'product_id' => $product_id,
                'stock' => $stock,
                'quantity' => $order_detail->quantity,
                "in_stock" => $stock >= $order_detail->quantity
            ];
        }
        if(collect($stocks)->pluck('in_stock')->contains(false)) {
            $errors["status"] = false;
            $errors["message"] = "Not enough product in your stock";
            return $errors;
        }
        // if everything okk complete order
        return DB::transaction(function() use ($b_order, $request, $order_details){
            $border = $b_order->first();
            $updated = $b_order->update([
                "status" => $request->status
            ]);
            $s_inserted = false;
            foreach ($order_details as $order_detail) {
                $product_id = $order_detail->product_json->product_details->id;
                $product_name = $order_detail->product_json->product_details->product_name;
                $order_quantity = $order_detail->quantity;
                $data = [
                    [
                        "bdealer_id"    => $border->assigned_to,
                        "product_id"    => $product_id,
                        "name"          => "sell",
                        "type"          => "sub",
                        "quantity"      => $order_quantity,
                        "message"       => "{$product_name} has been sold",
                        "created_at"    => Carbon::now(),
                        "updated_at"    => Carbon::now(),
                    ],
                    [
                        "bdealer_id"    => $border->bdealer_id,
                        "product_id"    => $product_id,
                        "name"          => "purchase",
                        "type"          => "add",
                        "quantity"      => $order_quantity,
                        "message"       => "{$product_name} has been purchased",
                        "created_at"    => Carbon::now(),
                        "updated_at"    => Carbon::now(),
                    ]
                ];
                $s_inserted = BdealerProductStock::insert($data);
            }
            $t_inserted = $border->bdealer_assign_to->transactions()->insert([
                "bdealer_id"                        => $border->assigned_to,
                "bdealer_transaction_category_id"   => 3,
                "type"                              => "c",
                "amount"                            => $border->amount,
                "data"                              => json_encode($border),
                "message"                           => "Your B-Dealer wallet has been credited for completing order no: {$border->serial}",
                "created_at"                        => Carbon::now(),
                "updated_at"                        => Carbon::now(),
            ]);

            return ["status" => true, "message" => "Order complete successful"];

        });
    }

}

