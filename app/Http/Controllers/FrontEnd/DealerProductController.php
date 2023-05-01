<?php

namespace App\Http\Controllers\FrontEnd;

use App\DealerCart;
use App\Http\Controllers\Controller;
use App\KuHelpers\Helpers;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerOrder;
use App\Model\Bdealer\BdealerOrderDetail;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Bdealer\BdealerTransaction;
use App\Model\CashBackTransaction\CashBackTransaction;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoBvonTransaction;
use App\Model\Ecommerce\EcoEntrepreneurTransaction;
use App\Model\Ecommerce\EcoReserveTransaction;
use App\Model\Matrix;
use App\Model\Product\Product;
use App\User;
//use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DealerProductController extends Controller
{


    public function order(){
            $products = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->get();
        return view('dealer.products', compact('products'));
    }




    public function orderDetails($id){
        $order = EcoOrder::where('id', $id)->with('manyOrders')->first();

        foreach ($order->manyOrders as $i => $item){
            $bdealers = Bdealer::where('user_id', Auth::user()->id)->first();

            $stock = BdealerProductStock::where(['product_id'=> $item->product_id, 'bdealer_id' => $bdealers->id])->count();
            $stockall = BdealerProductStock::where(['product_id'=> $item->product_id, 'bdealer_id' => $bdealers->id])->get();

            if($stock > 0){
                foreach ($stockall as $items){
                    if($items->quantity >= $item->product_quantity){
                            $values = 1;
                    }else{
                        $values = 0;
                        break;
                    }
                }

            }else{
                $values = 0;
                break;
            }

//            $nowby = DB::table('bdealer_product_stocks')->join('eco_order_details', 'eco_order_details.product_id', '=', 'bdealer_product_stocks.product_id')
//                ->where('eco_order_details.product_id', $item->product_id)->groupBy('eco_order_details.product_id')->get();
//           $product_id = array();
//           $product_id[] = $item->product_id;
//           print_r($product_id)  ;


//            $items = $order->manyOrders;
//                    $user[] = DB::table('eco_order_details')
//                        ->join("bdealer_product_stocks", function ($join) use ($items, $i) {
//                            $join->on("bdealer_product_stocks.product_id", "=", "eco_order_details.product_id")
//                                ->on("bdealer_product_stocks.dealer_referral_id", "=", "eco_order_details.dealer_referral_id")
//                                ->where('bdealer_product_stocks.dealer_referral_id', $items[$i]->dealer_referral_id)
//                                ->where('bdealer_product_stocks.product_id', $items[$i]->product_id);
//                        })
//                        ->get();
//
//            foreach ($user[$i][0] as $item) {
//                    $item = json_decode(json_encode($user[1][0]));
//                    echo "<pre>"; print_r($user[1][0]); die;
//                    }

//                    $values = 0;
//
//                    foreach ($nowby as $val){
//                        if($val->quantity >= $val->product_quantity){
//                            $values = 1;
//
//                        }else{
//                            $values = 0;
//                            break;
//                        }
//                    }


                }

//        foreach ($product_id as $key => $item){
//            echo $key."<br>";
//        }







        return view('dealer.order_details', compact('order', 'values'));
    }






    public function pendingOrder(){

            $pendingOrders = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->where('order_status', 'pending')->with('user')->get();

        return view('dealer.pending_order', compact('pendingOrders'));
    }


    public function pendingOrderDetails($id){
        $order = EcoOrder::where('id', $id)->first();
        return view('dealer.pending_order_details', compact('order'));
    }






    public function cancelOrder(){

        $cancelOrders = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->where('order_status', 'cancel')->with('user')->get();

        return view('dealer.cancel_order', compact('cancelOrders'));
    }


    public function cancelOrderDetails($id){
        $order = EcoOrder::where('id', $id)->first();
        return view('dealer.cancel_order_details', compact('order'));
    }



    public function completeOrder(){

        $completeOrders = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->where('order_status', 'complete')->with('user')->get();

        return view('dealer.complete_order', compact('completeOrders'));
    }


    public function completeOrderDetails($id){
        $order = EcoOrder::where('id', $id)->first();
        return view('dealer.complete_order_details', compact('order'));
    }


    public function processingOrder(){

        $processingOrders = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->where('order_status', 'processing')->with('user')->get();

        return view('dealer.processing_order', compact('processingOrders'));
    }


    public function processingOrderDetails($id){
        $order = EcoOrder::where('id', $id)->first();
        return view('dealer.processing_order_details', compact('order'));
    }



    public function shippingOrder(){

        $shippingOrders = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->where('order_status', 'shipped')->with('user')->get();

        return view('dealer.shipping_order', compact('shippingOrders'));
    }



    public function productStock(){

        $bdealers = Bdealer::where('user_id', Auth::user()->id)->first();
        $all_stocks = BdealerProductStock::where('bdealer_id', $bdealers->id)->with('product')->get();

//        $products = EcoProduct::all();
//        $all_stocks = json_decode(json_encode($all_stocks));
//        echo "<pre>"; print_r($all_stocks); die;
        return view('dealer.stock.stock', compact('all_stocks'));
    }


    public function employeeArena(){
        $users = User::where('referred_by', Auth::user()->referral_id)->get();
        return view('dealer.employee.employee_arena', compact('users'));
    }

    public function employeeArenaUser($id){
        $user = User::where('id', $id)->first();
        $users = User::where('referred_by', $user->referral_id)->get();
        return view('dealer.employee.employee_arena_single', compact('users', 'user'));
    }



    public function teamArenaUser(){
        $level_sponsor =Auth::user()->referral_id;
        $matrices = Matrix::query();
        if(request()->has('users')){
            if ($this->check_my_downline( request('users'), $level_sponsor)){
                $id =  request('users');
            }else{
                $id =  request('users');
            }
            $matrices->where('parent_id', $id);
        }else{
            $matrices->where('parent_id', $level_sponsor);
        }
        $matrices = $matrices->with("user")->get();
        return view('dealer.employee.matrix', compact('matrices'));
    }


    protected  function check_my_downline($user_id, $login_id){
        $data = Matrix::where('referral_id', $user_id)->first();
        $spon_id = $data->parent_id;

        while($spon_id != 0){
            if($spon_id == $login_id){
                return true;
            }else{
                $data = Matrix::where('referral_id', $user_id)->first();
                $spon_id = $data->parent_id;
                return false;
            }
        }

        if($spon_id == 0){
            return false;
        }
    }













    public function dealer_service(){

        return view('frontend.wallet.dealer');
    }

    public function dealerPurchase(){
//        $products = EcoProduct::orderByDesc('id')->get();
        $categories =EcoCategory::all();
        $delaerProducts = Bdealer::where('user_id', Auth::user()->id)->with('bdProduct')->get();

//            $delaerProductss = BdealerProduct::join('eco_products', 'eco_products.id', '=', 'bdealer_products.product_id')->where('eco_products.category_id', 1)->get();
//        $id = 5;
//        $userId = Auth::user()->id;
//        $delaerProductss =  BdealerProduct::with('media')
//            ->join("eco_products", function ($join) use($id){
//                $join->on("bdealer_products.product_id", "=", "eco_products.id")
//                    ->where('eco_products.category_id', $id);
//            })
//            ->join('bdealers', function ($join) use($userId){
//                $join->on('bdealers.bdealer_type_id', 'bdealer_products.bdealer_type_id')
//                    ->where('bdealers.user_id', $userId);
//            })
//            ->get();
//
//        $dealer_product = EcoProduct::with('bdealerProductPrice', 'media')->get();
//        $delaerProductss = json_decode(json_encode($delaerProductss));
//        echo "<pre>"; print_r($delaerProductss); die;



        return view('frontend.dealer.purchase', compact('categories'));
    }

    public function delaerProductFilter(Request $request)
    {
        $id = $request->id;
        $userId = Auth::user()->id;
        $dealer_product =  BdealerProduct::with('media')
            ->join("eco_products", function ($join) use($id){
                $join->on("bdealer_products.product_id", "=", "eco_products.id")
                    ->where('eco_products.category_id', $id)
                    ->where('eco_products.deleted_at', NULL);
            })
            ->join('bdealers', function ($join) use($userId){
                $join->on('bdealers.bdealer_type_id', 'bdealer_products.bdealer_type_id')
                    ->where('bdealers.user_id', $userId);
            })
            ->get();

            $parray = array();
            foreach ($dealer_product as $item) {
                $parray[] = $item;
            }
            return response()->json($parray);

    }



    public function addDealerCart(Request $request){
        $userID = Auth::user()->id;
        $data = [];
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['weight'] = 0;
        $data['qty'] = $request->qty;
        $data['price'] = $request->price;

//        echo "<pre>"; print_r($data); die;


        $add  = Cart::add($data);

        if($add) {
            session()->flash('msg', 'Product Added in Cart ');
            return redirect()->back();

        } else {

            session()->flash('msg', 'Cart Add failed');
            return redirect()->back();

        }
    }

    public function cartGet(){
        return Cart::content();
    }


    public function addDealerAjaxCart(Request $request){

            $products = EcoProduct::where('id', $request->id)->first();
            $dealerCart = new DealerCart();
            $dealerCart->product_id = $request->id;
            $dealerCart->product_name = $request->name;
            $dealerCart->price = $request->price;
            $dealerCart->size = $products->product_size;
            $dealerCart->quantity = $request->qty;
            $dealerCart->user_phone = Auth::user()->phone;
            $dealerCart->save();
            if($dealerCart){
                return response()->json($request->all());

            }
    }



    public function cartPage(){

        $userCart = DealerCart::all();

        foreach ($userCart as $key => $product){
//            echo $product->product_id;
            $productDetails = EcoProduct::where('id', $product->product_id)->with('media')->first();

            $userCart[$key]->product_image = $productDetails->media[0]->product_image;
        }

        $delers = Bdealer::where('user_id', Auth::user()->id)->join('villages', 'villages.thana_id', '=', 'bdealers.thana_id')->first();

//
//        $delers = json_decode(json_encode($delers));
//        echo "<pre>"; print_r($delers); die;
        return view('dealer.cart.cart-page', compact('userCart', 'delers'));
    }



    public function updateDealerProductQuantity(Request $request){


        $userId = Auth::user()->id;
        $product_id = $request->product_id;
        $dealer_product =  BdealerProduct::join('bdealers', function ($join) use($userId, $product_id){
            $join->on('bdealers.bdealer_type_id', 'bdealer_products.bdealer_type_id')
                ->where('bdealers.user_id', $userId)
                ->where('bdealer_products.product_id', $product_id);
        })
            ->first();

        if($request->quantity > $dealer_product->minimum_quantity){
            $product = DealerCart::findOrFail($request->id);
            $product->quantity = $request->quantity;
            $product->save();
            return response()->json([
                'message' => 'Product Quantity Updated Successfully !'
            ]);
        }else{
            return response()->json([
                'message' => 'Product Quantity need more thane minimum product quantity'
            ]);
        }
    }


    public function deleteDealerProductQuantity($id){
        $delete_cart = DealerCart::where('id', $id)->first();
        $delete_cart->delete();
        return redirect()->back();
    }





    public function checkout(Request $request){

        $data= $request->all();
        $delearscount = Bdealer::where('dealer_referral_id', Auth::user()->bdealer_reference_id)->count();
        if($delearscount > 0){
            $delearscount = Auth::user()->bdealer_reference_id;
        }else{
            $delearscount = null;
        }
        $dealerId = Bdealer::where('user_id', Auth::user()->id)->first();


        $balance = $dealerId->balance();
        $latest = BdealerOrder::latest()->first();

        $i = 1;
        $datas = explode("-", date('d-m-Y'));

        if($balance >= $data['grand_total']){
            $orders = new BdealerOrder();
            $orders->assigned_to  = $delearscount;
            $orders->bdealer_id  = $dealerId->id;
            $orders->pin  = rand(111111, 999999);
            $orders->amount = $data['grand_total'];
            $orders->serial = 'bVon-'. $datas[0].$datas[1].$datas[2]. $latest->id += $i;
            $orders->status = 'pending';
            $orders->delivery_address =$data['address'];
            $orders->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('dealer_carts')->where(['user_phone' => Auth::user()->phone])->get();
            foreach ($cartProducts as $pro){

                $echoProduct = EcoProduct::where('id', $pro->product_id)->first();


                $shipaddress = [
                    'order_details'=> [
                        'price' => $pro->price,
                        'product_id' => $pro->product_id,
                        'specification'=>[[
                            'size' => $pro->size,
                            'quantity'=>$pro->quantity
                            ]
                        ],

                    ],
                    'product_details' =>[
                        'id' => $pro->product_id,
                        'product_name'=> $echoProduct->product_name
                    ]
                ];

                $cartPro = new BdealerOrderDetail();
                $cartPro->bdealer_order_id  = $order_id;
                $cartPro->product_json = json_encode($shipaddress);
                $cartPro->quantity = $pro->quantity;
                $cartPro->save();
            }

            $datavalue = [
                'id' => Auth::user()->id ,
                'pin' => rand(111111, 999999),
                'amount' => $data['grand_total'],
                'serial' => 'bVon-'. $datas[0].$datas[1].$datas[2]. $latest->id += $i,
                'status'=> 'pending',
                'bdealer_id'=> $dealerId->id,
                'assigned_to' => $delearscount,
                'delivery_address' => $data['address'],
                'seen_status' => 0
            ];

            $transaction = new BdealerTransaction();
            $transaction->bdealer_id = $dealerId->id;
            $transaction->bdealer_transaction_category_id  = 2;
            $transaction->type = 'd';
            $transaction->amount = $data['grand_total'];
            $transaction->data = json_encode($datavalue);
            $transaction->message = null;


            DealerCart::where('user_phone', Auth::user()->phone)->delete();
            return redirect('/dealer_orders_page');

        }


    }



    public function dealerOrderPages(){
        $bdealer = Bdealer::where('user_id', Auth::user()->id)->first();
        $dealerOrderDetails = BdealerOrder::where('bdealer_id', $bdealer->id)->with('border_details')->orderByDesc('id')->get();
        $dealerOrderDetailss = BdealerOrder::where('bdealer_id', $bdealer->id)->with('border_details')->orderByDesc('id')->get();
//        $dealerOrderDetails = json_decode(json_encode($dealerOrderDetails));
//        echo "<pre>"; print_r($dealerOrderDetails); die;
        return view('dealer.cart.dealer_order_page', compact('dealerOrderDetails', 'dealerOrderDetailss'));
    }



    public function dealerOrderDetailsPagesNow($id){

        $orderdetials = BdealerOrderDetail::where('bdealer_order_id', $id)->get();
//        $orderdetials = json_decode(json_encode($orderdetials));
//        echo"<pre>"; print_r($orderdetials);die;
        return view('dealer.cart.dealer_order_page_details', compact('orderdetials'));
    }







public function updateDealerProductStatus(Request $request){
    $product = BdealerOrder::findOrFail($request->id);
    $product->status = 'cancel';
    $product->save();
    return response()->json();
}













    public function orderComplete(EcoOrder $order_id)
    {
        DB::beginTransaction();

        if($order_id->order_status == 'cancel' || $order_id->order_status == 'complete') return back()->with(["error" => "Order already cancel or completed"]);

        // order user referred by id
        $has_referred_by = $order_id->user->referred_by != NULL;

        $has_referred_by_dealer = $order_id->user->dealer_referral_by != NULL;







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
            $bdealerc =  Bdealer::where('user_id', Auth::user()->id)->count();
//            echo "<pre>"; print_r($bdealerc); die;
            if($bdealerc > 0){
                $bdealer =  Bdealer::where('user_id', Auth::user()->id)->first();

                $ordersnows = EcoOrderDetail::join('bdealer_product_stocks', 'bdealer_product_stocks.product_id','=', 'eco_order_details.product_id')->where('eco_order_details.order_id', $order_id->id)->where('bdealer_product_stocks.bdealer_id', $bdealer->id)->get();
//                $ordersnows = json_decode(json_encode($ordersnows));
//                echo "<pre>"; print_r($ordersnows);die;
                foreach ($ordersnows as $ordersnow){
                    $qty = $ordersnow->quantity - $ordersnow->product_quantity;
                    BdealerProductStock::where(['bdealer_id' => $bdealer->id, 'product_id'=> $ordersnow->product_id])->update(['quantity' => $qty]);
                }



            }

            return back()->with(['success' => 'Order Complete Successful']);
        }
    }


    protected function giveSrAmount($sr_amount_array, $order_id, $detail) {
        $sr_amount_collection = collect($sr_amount_array);
        $sr_tree_upper = collect([]);
        for($i = 0; $i < $sr_amount_collection->count(); $i++) {
            $sr_user = false;
            if($sr_tree_upper->count() < 1) {
                if($order_id->is_default === 1) {
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






    public function shipped($id){
        EcoOrder::where('id', $id)->update(['order_status'=> 'shipped']);
        return back()->with(['success' => 'Order shipped successful!']);
    }


    public function process($id){
        EcoOrder::where('id', $id)->update(['order_status'=> 'processing']);
        return back()->with(['success' => 'Order processing successful!']);
    }

    public function cancel($id){
        EcoOrder::where('id', $id)->update(['order_status'=> 'cancel']);
        return back()->with(['success' => 'Order Canceled successful!']);
    }

























}
