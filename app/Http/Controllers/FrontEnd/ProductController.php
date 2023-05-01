<?php

namespace App\Http\Controllers\FrontEnd;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Cart;
use App\Model\DeliveryAddress;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\EcoBrand;
use App\Model\Ecommerce\EcoShop;
use App\User;
use App\UserJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public  function product($product_url){

        $productDetails = EcoProduct::where('product_url', $product_url)->first();
//        $productDetails = json_decode(json_encode($productDetails));
//        echo "<pre>"; print_r($productDetails); die;

        $g_products = EcoProduct::where('category_id', $productDetails->category_id)->inRandomOrder()->limit(16)->get();
        return view('product.details', compact('g_products', 'productDetails'));
    }






    public function products($product_urls)
    {

        $shopCats = EcoShop::where('url', $product_urls)->get();

        foreach ($shopCats as $key => $value) {
            $shop_id[] = $value->id;
        }
        if (isset($shop_id)) {
            $productSection = EcoProduct::whereIn('eco_products.shop_id', $shop_id);

        }


        $brandCats = EcoBrand::where('url', $product_urls)->get();

        foreach ($brandCats as $key => $value) {
            $brand_id[] = $value->id;
        }
        if (isset($brand_id)) {
            $productSection = EcoProduct::whereIn('eco_products.brand_id', $brand_id);

        }
//        echo $sectionCat; die;
        $sectionCat = EcoCategory::where('url', $product_urls)->get();

        foreach ($sectionCat as $key => $value) {
            $sec_id[] = $value->id;
        }

        if (isset($sec_id)) {
            $productSection = EcoProduct::whereIn('eco_products.category_id', $sec_id);

        }

        $sectionSubCat = EcoSubCategory::where('url', $product_urls)->get();
        foreach ($sectionSubCat as $key => $value) {
            $cat_id[] = $value->id;
        }
        if (isset($cat_id)) {
            $productSection = EcoProduct::whereIn('eco_products.subcategory_id', $cat_id);

        }

        $products = $productSection->paginate(16);

        return view('product.products', compact('products'));
    }













    public function addCart(Request $request){

        if($request->isMethod('post')){
            Session::forget('CouponAmount');
            Session::forget('CouponCode');
            $data = $request->all();

            if(empty($data['size'])){
                $data['size'] = '';
            }

            if(empty($data['color'])){
                $data['color'] = '';
            }

            if(empty($data['quantity'])){
                $data['quantity'] = 1;
            }

            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Str::random(40);
                Session::put('session_id', $session_id);
            }
            if(Auth::check()){
                $user_phone = Auth::user()->phone;
                $countProduct =  DB::table('carts')->where(['product_id' => $data['product_id'], 'user_phone' => $user_phone])->count();
            }else{
                $countProduct =  DB::table('carts')->where(['product_id' => $data['product_id'], 'session_id' => $session_id])->count();
            }


            if($countProduct > 0){
                return redirect()->back();
            }else{
                if(Auth::check()){

                    $user_phone = Auth::user()->phone;
                    DB::table('carts')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'],  'price'=> $data['price'], 'premium_price' => $data['preprice'], 'size' => $data['size'], 'quantity' => $data['quantity'], 'user_phone' => $user_phone, 'session_id' => $session_id, 'color' => $data['color'], 'product_url' => $data['product_url']]);
                }else{
                    DB::table('carts')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'],  'price'=> $data['price'], 'premium_price' => $data['preprice'], 'size' => $data['size'], 'quantity' => $data['quantity'], 'user_phone' => '', 'session_id' => $session_id, 'color' => $data['color'], 'product_url' => $data['product_url']]);
                }
                return redirect('cart');
            }
        }
    }






    public function cart(){

        if(Auth::check()){
            $user_phone = Auth::user()->phone;
            $userCart = DB::table('carts')->where(['user_phone' => $user_phone])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
        }

        foreach ($userCart as $key => $product){
//            echo $product->product_id;
            $productDetails = EcoProduct::where('id', $product->product_id)->with('media')->first();
            $userCart[$key]->product_image = $productDetails->media[0]->product_image;
        }

//                echo "<pre>"; print_r($userCart); die;

        return view('product.cart',compact('userCart'));
    }



    public function deleteQuantity($id){
        $delete_cart = Cart::where('id', $id)->first();
        $delete_cart->delete();
        return redirect()->back();
    }

    public function updateProductQuantity(Request $request){
            if($request->quantity > 0){
                $product = Cart::findOrFail($request->id);
                $product->quantity = $request->quantity;
                $product->save();
                return response()->json([
                    'message' => 'Product Quantity Updated Successfully !'
                ]);
            }else{
                return response()->json([
                    'message' => 'Product Quantity need more thane one '
                ]);
            }
         }



    public function applyCoupon(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
//    echo "<pre>"; print_r($data); die;
        $couponCount = Coupon::where(['coupon_code' => $data['coupon_code']])->count();

        if($couponCount == 0){
            return redirect()->back();
        }else{
            // coupon details
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();
            // If Coupon code is Inactive
            if($couponDetails->status ==0){
                return redirect()->back();
            }

            // If coupon si expiry
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');

            if($expiry_date < $current_date){
                return redirect()->back();
            }

            // get cart total amount
            if(Auth::check()){
                $user_phone = Auth::user()->phone;
                $userCart = DB::table('carts')->where(['user_phone' => $user_phone])->get();
            }else{
                $session_id = Session::get('session_id');
                $userCart = DB::table('carts')->where(['session_id'=> $session_id])->get();

            }


            $total_amount = 0;
            foreach ($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            // if check amount type is fixed or percentage
            if($couponDetails->amount_type == "Fixed"){
                $couponAmount =  $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // Add coupon amount in session
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);
            return redirect()->back();
        }
    }


    public function checkout(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data);die;
            $user_id = Auth::id();

            if(empty($data['billing_name']) || empty($data['billing_address'])){
                return redirect()->back();
            }

            if( empty($data['billing_city'])){
                $data['billing_city'] ='';
            }

            if(empty($data['billing_thana'])){
                $data['billing_thana'] = '';
            }

            if(empty($data['billing_zip'])){
                $data['billing_zip'] ='';
            }

            if(empty($data['billing_phone'])){
                $data['billing_phone'] = '';
            }

            if(empty($data['billing_house'])){
                $data['billing_house'] = '';
            }

            if(empty($data['billing_road'])){
                $data['billing_road'] = '';
            }







            if(empty($data['shipping_city'])){
                $data['shipping_city'] = '';
            }

            if(empty($data['shipping_thana'])){
                $data['shipping_thana'] = '';
            }

            if(empty($data['shipping_phone'])){
                $data['shipping_phone'] = '';
            }
            if(empty($data['shipping_road'])){
                $data['shipping_road'] = '';
            }
            if(empty($data['shipping_house'])){
                $data['billing_road'] = '';
            }
            if(empty($data['billing_road'])){
                $data['shipping_house'] = '';
            }

            if(empty($data['shipping_zip'])){
                $data['shipping_zip'] = '';
            }


            $dataaddress = [
              'billing_address'=> $data['billing_address'],
              'billing_phone'=> $data['billing_phone'],
              'billing_house'=> $data['billing_house'],
              'billing_road'=> $data['billing_road'],
              'billing_city' => $data['billing_city'],
              'billing_thana' => $data['billing_thana'],
              'billing_zip'  => $data['billing_zip']

            ];

            // Update User Details
            User::where('id', $user_id)->update(['address' => json_encode($dataaddress)]);
            $user_phone = Auth::user()->phone;
            $shippingcount = DeliveryAddress::where('user_id', Auth::id())->count();

            $shipaddress = [
                'address' => $data['shipping_address'],
                'district' => $data['shipping_city'],
                'city' => $data['shipping_thana'],
                'phone' => $data['shipping_phone'],
                'road_no' => $data['shipping_road'],
                'postal_code' => $data['shipping_zip'],
                'ps' => '',
                'house_no' => $data['shipping_house']
            ];

            if($shippingcount > 0){
                // update shipping address


                DeliveryAddress::where('user_id', $user_id)->update(['user_phone' => $user_phone, 'address' => json_encode($shipaddress)]);
            }else{
                // add new shipping address
                $shipping = new DeliveryAddress();
                $shipping->user_id = $user_id;
                $shipping->user_phone = $user_phone;
                $shipping->name = Auth::user()->name;
                $shipping->address = json_encode($shipaddress);
                $shipping->save();

            }


            $latest = EcoOrder::latest()->first();

            $i = 1;
            $datas = explode("-", date('d-m-Y'));

            $delearscounts = User::where('dealer_referral_id', Auth::user()->dealer_referral_by)->count();

            $orders = new EcoOrder();

            if($delearscounts > 0){
                $delearbddddddd = Auth::user()->dealer_referral_by;
                $orders->assign_bdealer_id = $delearbddddddd;
//                echo '<pre>'; print_r($orders->dealer_account); die;
            }else{
                $delearbddddddd = 0;
                $orders->assign_bdealer_id = $delearbddddddd;
            }

            if(empty($data['payment_method'])){
                $data['payment_method'] = '';
            }

            if(empty($data['shipping_method'])){
                $data['shipping_method'] = '';
            }


            $orders->order_amount = $data['grand_total'];
            $orders->order_serial = 'bVon-'. $datas[0].$datas[1].$datas[2]. $latest->id += $i;
            $orders->order_status = 'pending';
            if($request->type == 'other'){
                $orders->is_default = 1;
            }else{
                $orders->is_default = 0;
            }
            $orders->payment_status = 'pending';
            $orders->user_id = Auth::id();
            $orders->address = json_encode($shipaddress);
            $orders->shipping_method = $data['shipping_method'];

            $orders->payment_method = $data['payment_method'];
            if($data['payment_method'] == 'Nagad'){
                $orders->sender_number = $data['SenderMobile'][0];
                $orders->transaction = $data['transaction'][0];
                $orders->amount = $data['amount'][0];
            }

            if($data['payment_method'] == 'Bikash'){
                $orders->sender_number = $data['SenderMobile'][1];
                $orders->transaction = $data['transaction'][1];
                $orders->amount = $data['amount'][1];
            }

            $orders->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('carts')->where(['user_phone' => $user_phone])->get();
            foreach ($cartProducts as $pro){
                $cartPro = new EcoOrderDetail();
                $cartPro->order_id = $order_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_quantity = $pro->quantity;
                if(Auth::user()->type !='GU'){
                    if($request->type == ''){
                        $cartPro->product_price = $pro->premium_price;
                    }else if($request->type == 'other'){
                        $cartPro->product_price = $pro->price;
                    }

                }else{
                    $cartPro->product_price = $pro->price;
                }

                $cartPro->color = $pro->color;
                $cartPro->size = $pro->size;
                $cartPro->save();
            }
            Cart::where('user_phone', Auth::user()->phone)->delete();
            return redirect('/thanks');
        }



        if(Auth::check()){
            $user_phone = Auth::user()->phone;
            $userCart = DB::table('carts')->where(['user_phone' => $user_phone])->get();
            $session_id = Session::get('session_id');
            DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $user_phone]);


        }

        foreach ($userCart as $key => $product){
//            echo $product->product_id;
            $productDetails = EcoProduct::where('id', $product->product_id)->with('media')->first();
            $userCart[$key]->product_image = $productDetails->media[0]->product_image;
        }

        $thanas = Thana::all();
        $jobAssigns = UserJob::where('user_id', Auth::user()->id)->count();
        $cities = District::all();

        $userDetails = User::where('id', Auth::id())->first();
//        foreach (json_decode($userDetails->address) as $key => $item) {
//            echo "<pre>"; print_r($key .':'.$item);die;
//        }

//        $deliveryaddress = DeliveryAddress::where('user_id', Auth::id())->first();
            $deliveryaddressCount = DeliveryAddress::where('user_id', Auth::id())->count();
            $deliveryaddress = DeliveryAddress::where('user_id', Auth::id())->first();
            $deliveryaddress = json_decode( json_encode($deliveryaddress), false);

            $useraddresses = User::where('id', Auth::id())->first();
//            $useraddresses = json_decode( json_encode($useraddresses), false);


        return view('product.checkout', compact('userCart', 'thanas', 'jobAssigns', 'userDetails', 'cities', 'deliveryaddress', 'useraddresses', 'deliveryaddressCount'));
    }



    public function otherOrders(){


        if(Auth::check()){
            $user_phone = Auth::user()->phone;
            $userCart = DB::table('carts')->where(['user_phone' => $user_phone])->get();
            $session_id = Session::get('session_id');
            DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $user_phone]);


        }

        foreach ($userCart as $key => $product){
//            echo $product->product_id;
            $productDetails = EcoProduct::where('id', $product->product_id)->with('media')->first();
            $userCart[$key]->product_image = $productDetails->media[0]->product_image;
        }

        $thanas = Thana::all();
        $jobAssigns = UserJob::where('user_id', Auth::user()->id)->count();
        $cities = District::all();

        $userDetails = User::where('id', Auth::id())->first();
//        foreach (json_decode($userDetails->address) as $key => $item) {
//            echo "<pre>"; print_r($key .':'.$item);die;
//        }

        $deliveryaddressCount = DeliveryAddress::where('user_id', Auth::id())->count();
        $deliveryaddress = DeliveryAddress::where('user_id', Auth::id())->first();
        $deliveryaddress = json_decode( json_encode($deliveryaddress), false);

        $useraddresses = User::where('id', Auth::id())->first();

        return view('product.other_order',  compact('userCart', 'thanas', 'jobAssigns', 'userDetails', 'cities', 'deliveryaddress', 'useraddresses', 'deliveryaddressCount'));
    }


    public function thanks(){
        $orders = EcoOrder::where('user_id', Auth::user()->id)->join('eco_order_details', 'eco_order_details.order_id', '=', 'eco_orders.id')->join('eco_products','eco_products.id', '=', 'eco_order_details.product_id')->orderByDesc('eco_orders.id')->get();
//        $orders = json_decode(json_encode($orders));
//        echo "<pre>"; print_r($orders); die;
        return view('product.thanks', compact('orders'));
    }


    public function changeThana($id){
        echo json_encode(DB::table('thanas')->where('district_id', $id)->get());
    }


    public function orderDetailsPageNow(Request $request){
        $orderdetials = EcoOrderDetail::where('order_id', $request->id)->join('eco_products', 'eco_products.id', '=','eco_order_details.product_id')->select('eco_products.product_name', 'eco_order_details.product_price', 'eco_order_details.product_quantity', 'eco_order_details.size','eco_order_details.id','eco_order_details.created_at')->get();
        return response()->Json($orderdetials);
    }




    public function updateStatusGcart(Request $request){
        $product = EcoOrder::findOrFail($request->id);
        $product->order_status = 'cancel';
        $product->save();
        return response()->json();
    }


    public function searchProduct(Request $request){
//        echo "<pre>"; print_r($data); die;
        if($request->get('query')){

            $search_product = $request->get('query');
            $products = EcoProduct::where(function ($query) use ($search_product){
                $query->where('product_name', 'like', '%'.$search_product.'%');})
               ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($products as $product)
            {
                $output .= '
               <li><a href="#" style="text-decoration: none; color: #000; padding: 6px;;">'.$product->product_name.'</a></li>
               ';
                    }
                    $output .= '</ul>';
                    echo $output;

        }

    }





    public function getSearchData(Request $request){

            $search_product = $request->get('query');
            $products = EcoProduct::where(function ($query) use ($search_product){
                $query->where('product_name', 'like', '%'.$search_product.'%');
            })
                ->paginate(16);
//            $breadcrumb = "<a href='/'>Home</a> /". $search_product;
            return view('product.listing',compact('products'));

    }


//->orwhere('product_code', 'like', '%'.$search_product.'%')
//->orwhere('description', 'like', '%'.$search_product.'%')
//->orwhere('product_color', 'like', '%'.$search_product.'%')
































    public function updateProductUrl(Request $request){
        $product = EcoProduct::where('id', $request->id)->first();
        $product->product_url = Str::slug($request->product_url);
        $product->save();
        return response()->json(['message'=> 'Product Url Updated Successfully']);
    }


}
