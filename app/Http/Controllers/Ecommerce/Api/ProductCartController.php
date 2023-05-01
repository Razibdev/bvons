<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\EcoOrderDetailResource;
use App\Http\Resources\ThanaResource;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Cart;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\Api\EcoProduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductCartController extends Controller
{
    public function index(){
        $session_id = Cookie::get('session_id');
        $cart =  Cart::with('product')->where('session_id', $session_id)->orderBy('created_at', 'desc')->get();
         $cart = CartResource::collection($cart);
        return response()->json($cart);
    }



    public function store(Request $request){
        $item = Cart::where(['product_id'=> $request->product_id, 'session_id' => $request->session_id]);
        $product = EcoProduct::where('id', $request->product_id)->first();
        if($item->count()){
            $item->increment('quantity');
            $item = $item->first();
        }else{
            $item = Cart::forceCreate([
                'product_id' => $request->product_id,
                'session_id' => $request->session_id,
                'quantity' => $request->quantity,
                'product_name' => $product->product_name,
                'product_url' => $product->product_url,
                'price' => $product->user_price,
                'premium_price' => $product->premium_price,
                'product_media' => $request->product_media
            ]);
        }

        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'product_media' => $item->product_media,
            'session_id' => $item->session_id
        ]);
    }

public function updateQty(Request $request){
    $item = Cart::where('id', $request->id);
    $item->decrement('quantity');
    $item = $item->first();

    return response()->json([
        'quantity' => $item->quantity,
        'product' => $item->product,
        'product_media' => $item->product_media,
        'session_id' => $item->session_id
    ]);
}

public function updateCartQty(Request $request){
    $item = Cart::where('product_id', $request->id);
    $item->decrement('quantity');
    $item = $item->first();

    return response()->json([
        'quantity' => $item->quantity,
        'product' => $item->product,
        'product_media' => $item->product_media,
        'session_id' => $item->session_id
    ]);
}

public function updateCartQtyPlus(Request $request){
    $item = Cart::where('product_id', $request->id);
    $item->increment('quantity');
    $item = $item->first();

    return response()->json([
        'quantity' => $item->quantity,
        'product' => $item->product,
        'product_media' => $item->product_media,
        'session_id' => $item->session_id,

    ]);
}

    public function destroy(Request $request){
        $item = Cart::where('product_id', $request->id)->delete();
        return response(null, 200);
    }

    public function cartAuthUpdate(Request $request){
        $user = User::where('id', $request->user_id)->first();
        Cart::where('session_id', $request->session_id)->update(['user_id'=> $request->user_id, 'user_phone' => $request->phone, 'user_type' => $user->type]);
    }

    public function orderComplete(Request $request){
        $data = $request->all();
        User::where('id', $data['info']['id'])->update(['name' => $data['info']['name'], 'phone' => $data['info']['phone'], 'address' => $data['info']['full_address']]);

        $current_user = User::where('id', $data['info']['id'])->first();
//        if($current_user->dealer_referral_id != NULL){
//            $dealer_referral_id = $current_user->dealer_referral_id;
//        }

        if($current_user->dealer_referral_by != NULL){
            $dealer_referral_id = $current_user->dealer_referral_by;
        }
        else{
            $dealer_referral_id = null;
        }
        $datas = explode("-", date('d-m-Y'));
        $latest = EcoOrder::latest()->first();
        $i = 1;
        $order = new EcoOrder();
        $order->assign_bdealer_id = $dealer_referral_id;
        $order->order_amount = $data['total'];
        $order->order_status = 'pending';
        $order->order_serial = 'bVon-'. $datas[0].$datas[1].$datas[2]. $latest->id += $i;
        $order->payment_status = 'pending';
        $order->user_id  = $data['info']['id'];
        $order->thana  = $data['info']['area'];
        $order->delivery_date  = $data['info']['date'];
        $order->delivery_time  = $data['info']['time'];
        $order->payment_method  = $data['info']['payment'];
        if($data['info']['type'] == 'other'){
            $order->is_default  = 1;
        }
        $order->districts  = $data['city'];
        $order->save();

        $session_id = Cookie::get('session_id');

        $order_id = DB::getPdo()->lastInsertId();
        $cartProducts = DB::table('carts')->where(['session_id' => $session_id])->get();
        foreach ($cartProducts as $pro){
            $cartPro = new EcoOrderDetail();
            $cartPro->order_id = $order_id;
            $cartPro->product_id = $pro->product_id;
            $cartPro->product_quantity = $pro->quantity;
            if($current_user->type !='GU'){
//                if($request->type == ''){
                if($data['info']['type'] == 'other'){
                    $cartPro->product_price = $pro->price;

                }else{
                    $cartPro->product_price = $pro->premium_price;

                }
//                }else if($request->type == 'other'){
//                    $cartPro->product_price = $pro->price;
//                }

            }else{
                $cartPro->product_price = $pro->price;
            }

            $cartPro->color = $pro->color;
            $cartPro->size = $pro->size;
            $cartPro->save();
        }
        Cart::where(['session_id' => $session_id])->delete();

    }



    public function orderList($id){
        $orders = EcoOrder::where('user_id', $id)->orderByDesc('id')->get();
        return response()->json(
             $orders
        );
    }

    public function orderCancel($id){
        $orders = EcoOrder::where('id', $id)->update(['order_status' => 'cancel']);
        return response()->json(
            $orders
        );
    }


    public function showSingleOrderDetails($id){
        $orderDetails = EcoOrderDetailResource::collection(EcoOrderDetail::where('order_id', $id)->get());

        return response()->json(
            $orderDetails
        );
    }




    public function district(){
        return DistrictResource::collection(District::orderBy('name', 'asc')->get());
    }

    public function area(){
        $district = request('district_id');
        $area = Thana::where('district_id', $district)->get();
        return ThanaResource::collection($area);
    }


}
