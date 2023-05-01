<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoMedia;
use App\Model\Ecommerce\EcoPayment;
use App\Model\Matrix;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EcoOrderCollection;

class DealerSectionController extends Controller
{
    public function allOrder(){
//        \Log::info(Auth::user()->referral_id);
         $order = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->with('orderUser')->get();
         return $order;
    }

    public function pendingOrder(){
        $order = EcoOrder::where(['assign_bdealer_id'=> Auth::user()->dealer_referral_id, 'order_status' => 'pending'])->with('orderUser')->get();
        return $order;
    }

    public function processingOrder(){
        $order = EcoOrder::where(['assign_bdealer_id'=> Auth::user()->dealer_referral_id, 'order_status' => 'processing'])->with('orderUser')->get();
        return $order;
    }

    public function shippingOrder(){
        $order = EcoOrder::where(['assign_bdealer_id'=> Auth::user()->dealer_referral_id, 'order_status' => 'shipped'])->with('orderUser')->get();
        return $order;
    }

    public function CompleteOrder(){
        $order = EcoOrder::where(['assign_bdealer_id'=> Auth::user()->dealer_referral_id, 'order_status' => 'complete'])->with('orderUser')->get();
        return $order;
    }


    public function cancelOrder(){
        $order = EcoOrder::where(['assign_bdealer_id'=> Auth::user()->dealer_referral_id, 'order_status' => 'cancel'])->with('orderUser')->get();
        return $order;
    }


    public function orderDetials($id){
        $check = EcoOrder::where('assign_bdealer_id', Auth::user()->dealer_referral_id)->count();
        if ($check > 0){
            \Log::info($id);
            $orderDetails = EcoOrderDetail::where('order_id',$id)->with('product', 'media')->get();
            $order = EcoOrder::where('id', $id)->with('orderUser', 'districts', 'thana')->first();
            $payment = EcoPayment::where('order_id', $id)->get();



            $orders = EcoOrder::where('id', $id)->with('manyOrders')->first();
            $product_name = [];
            $not_purchase = [];
            foreach ($orders->manyOrders as $i => $item) {
                $bdealers = Bdealer::where('user_id', Auth::user()->id)->first();

                $stock = BdealerProductStock::where(['product_id' => $item->product_id, 'bdealer_id' => $bdealers->id])->count();
                $stockall = BdealerProductStock::where(['product_id' => $item->product_id, 'bdealer_id' => $bdealers->id])->with('product')->get();

                if ($stock > 0) {

//                    $product_name = [ 0 => 'Others' ];
                    foreach ($stockall as $items) {
                        if ($items->quantity >= $item->product_quantity) {
//                            $values = 1;
                        } else {
//                            $product_name = $items->product->product_name;

                            $echo_product = EcoProduct::where('id', $item->product_id)->select('id', 'product_name')->first();
                            $image = EcoMedia::where('product_id', $item->product_id)->first();
//                            $product_name[$item->product_id] = $echo_product->product_name;
                            array_push($product_name, $echo_product->product_name.','.$image->product_image);
//                            array_push($image, $echo_product->product_name.','.$image->product_image);
//                            array_push($product_name, $image->product_image);
//                            $values = 0;
//                            break;
                        }
                    }

                } else {
                    $echo_product = EcoProduct::where('id', $item->product_id)->select('id', 'product_name')->first();
                    $image = EcoMedia::where('product_id', $item->product_id)->first();
                    array_push($not_purchase, $echo_product->product_name.','.$image->product_image);
//                    $values = 0;
//                    break;
                }
            }



            return response()->json([
                'orderDetails' => $orderDetails,
                'order' => $order,
                'payment' => $payment,
                'product_name' => $product_name,
                'orders' => $orders,
                'not_purchase' => $not_purchase
            ]);
        }else{
            return response()->json([
                'orderDetails' => [],
                'order' =>[],
                'payment' => []
            ]);
        }
    }

    public function orderProcessing($processing, $id){
//        \Log::info($request->id);
        EcoOrder::where('id', $id)->update(['order_status' => $processing]);
        return response()->json(['id' => $id, 'message' => 'This product order status in processing!!', 'type' => 'success']);
    }



    public function orderShipped($shipped, $id){
        EcoOrder::where('id', $id)->update(['order_status' => $shipped]);
        return response()->json(['id' => $id, 'message' => 'This product order status in Shipped!!', 'type' => 'success']);
    }


    public function orderComplete($complete, $id){

        EcoOrder::where('id', $id)->update(['order_status' => $complete]);

        $orders = EcoOrder::where('id', $id)->with('manyOrders')->first();
        $bdealers = Bdealer::where('user_id', Auth::user()->id)->first();
        foreach ($orders->manyOrders as $i => $item) {
            $minus = 0;
            $ds =  BdealerProductStock::where(['product_id' => $item->product_id, 'bdealer_id' => $bdealers->id])->first();
            $minus = $ds->quantity - $item->product_quantity;
            BdealerProductStock::where(['product_id' => $item->product_id, 'bdealer_id' => $bdealers->id])->update(['quantity' => $minus]);
        }

        return response()->json(['id' => $id, 'message' => 'This product order status in Complete!!', 'type' => 'success']);
    }

    public function orderCancel($cancel, $id){
        EcoOrder::where('id', $id)->update(['order_status' => $cancel]);
        return response()->json(['id' => $id, 'message' => 'This product order status in cancle!!', 'type' => 'error']);
    }




    public function allStockDealer(){
        $bdealer = Bdealer::where('user_id', Auth::id())->first();
        $allStock = BdealerProductStock::where('bdealer_id', $bdealer->id)->with('product', 'media')->orderByDesc('id')->get();
        return $allStock;
    }


    public function employeeAreaNa(){
        $users = User::where('referred_by', Auth::user()->referral_id)->get();
//        $countrow = User::where('referred_by', Auth::user()->referral_id)->count();
        $countrow =[];
        foreach ($users as $key => $item){
            if($item->referral_id != null){
                $countrow[$item->id] = User::where('referred_by', $item->referral_id)->count();

            }
        }
        return response()->json([
            'data' => $users,
            'countrow' => $countrow
        ]);
    }

//    public function employeeAreaNaCount($id){
//        $userCount = User::where('referred_by', $id)->count();
//        $users = User::where('referral_id', $id)->first();
//        $users = $users->referral_id;
//        return response()->json([
//            'count' => $userCount,
//            'referral_id' => $users
//        ]);
//    }

public function employeeAreaNaDetails($id){
    $users = User::where('referred_by',$id)->get();
//        $countrow = User::where('referred_by', Auth::user()->referral_id)->count();
    $countrow =[];
    foreach ($users as $key => $item){
        if($item->referral_id != null){
            $countrow[$item->id] = User::where('referred_by', $item->referral_id)->count();
        }
    }
    return response()->json([
        'data' => $users,
        'countrow' => $countrow
    ]);
}


public function employeeDownline(){
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
    return $matrices;
}
public function employeeDownlineDetails($users){
    $level_sponsor =Auth::user()->referral_id;
    $matrices = Matrix::query();
        if ($this->check_my_downline( $users, $level_sponsor)){
            $id = $users;
        }else{
            $id =  $users;
        }
        $matrices->where('parent_id', $id);

    $matrices = $matrices->with("user")->get();
    return response()->json(['data' => $matrices, 'referral_id' => $users]);
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









}
