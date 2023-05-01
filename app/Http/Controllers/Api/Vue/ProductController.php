<?php

namespace App\Http\Controllers\Api\Vue;

use App\DealerCart;
use App\Http\Controllers\Area\DistrictController;
use App\Http\Controllers\Controller;
use App\Http\Resources\BdealerProductCollection;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\ThanaResource;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Village;
use App\Model\Area\Zone;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerOrder;
use App\Model\Bdealer\BdealerOrderDetail;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerType;
use App\Model\Ecommerce\Api\EcoProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function dealerIndex(){
        $bdealerc = Bdealer::where(['user_id' => Auth::id(), 'status' => 'active'])->count();
        $dealer = '';
        if ($bdealerc){
            $bdealer = Bdealer::where('user_id', Auth::id())->first();
            $dealer = BdealerProduct::with('media')->where('bdealer_type_id', $bdealer->bdealer_type_id)->join('eco_products', 'eco_products.id', 'bdealer_products.product_id')->where('eco_products.deleted_at', null)->select('bdealer_products.*', 'eco_products.product_name', 'eco_products.product_size')->paginate(18);

        }



        //        $products = [];
//        foreach ($dealer as $key => $item){
//            $products[$key] = EcoProduct::with('media')->where('id', $item->product_id)->where('deleted_at', null)->get();
//        }
////        $products = $products->paginate(18);

        return $dealer;
    }



    public function dealerAddCart(Request $request){
        $item = DealerCart::where(['product_id'=> $request->product['product_id'], 'user_id' =>Auth::id()]);

//        $product = BdealerProduct::where('id', $request->id)->first();
        if($item->count()){
            $item->increment('quantity');
            $item = $item->first();
        }else{
            $item = DealerCart::forceCreate([
                'product_id' => $request->product['product_id'],
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'product_name' => $request->product['product_name'],
                'size' => $request->product['product_size'],
                'price' => $request->product['purchase_price'],
                'product_media' => $request->product_media
            ]);
        }

        return response()->json([
            'quantity' => $item->quantity,
            'product' => $request->product,
            'product_media' => $item->product_media
        ]);
    }



    public function dealerGetCart(){
        $cart =  DealerCart::with('product')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return response()->json($cart);
    }




    public function decreaseDealerCartQty(Request $request){
        $item = DealerCart::where('id', $request['id']);
//        \Log::info($request);
        $item->decrement('quantity');
        $item = $item->first();

        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'product_media' => $item->product_media
        ]);
    }


    public function increaseDealerCartQty(Request $request){
        $item = DealerCart::where('id', $request->id);
        $item->increment('quantity');
        $item = $item->first();

        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'product_media' => $item->product_media
        ]);
    }



    public function dealerCartItemDelete(Request $request){
        $item = DealerCart::where('id', $request->id)->delete();
        return response(null, 200);
    }





    public function dealerOrderComplete(Request $request){
//        \Log::info($request);
        $total_verified_today = BdealerOrder::whereDate('created_at', date('Y-m-d'))->count();
        $limit = 9999 + 1;
        $serial = Str::substr((string)($limit + $total_verified_today + 1), 1);
        $now = Carbon::now();
        $referral_id = $now->format('dmy') . "{$serial}";
        $referral_id = 'bVon-D-'.$referral_id;


        $dealer = Bdealer::where('user_id', Auth::id())->first();

        $dealerOrder = new BdealerOrder();
        $dealerOrder->bdealer_id  = $dealer->id;
        $dealerOrder->serial = $referral_id;
        $dealerOrder->pin = substr(number_format(time() * rand(),0,'',''),0,6);
        $dealerOrder->amount = $request['total'];
        $dealerOrder->status = 'pending';
        $dealerOrder->delivery_address = $request['address'];
        $dealerOrder->phone = $request['phone'];
        $dealerOrder->save();
        $dealer_id = DB::getPdo()->lastInsertId();

        foreach ($request['cart'] as $key => $item){
//            \Log::info($item['quantity']);

            $product = array(
                'order_details' => array(
                    'price' => $item['price'],
                    'product_id' => $item['product_id'],
                    'specification' =>  array(array(
                        'size' => $item['size'],
                        'quantity' => $item['quantity']
                    ))

                ),
                'product_details' => array(
                    'id' =>  $item['product_id'],
                    'product_name' =>  $item['product_name']
                )
            );
            \Log::info(json_encode($product));

            $dealerorderDetails = new BdealerOrderDetail();
            $dealerorderDetails->bdealer_order_id  = $dealer_id;
            $dealerorderDetails->product_json =json_encode($product);
            $dealerorderDetails->product_name =$item['product_name'];
            $dealerorderDetails->product_size = $item['size'];
            $dealerorderDetails->price = $item['price'];
            $dealerorderDetails->quantity = $item['quantity'];
            $dealerorderDetails->save();


        }

        DealerCart::where('user_id', Auth::id())->delete();
        return response()->json();

    }

    public function getDealerOrderList(){
        $dealer = Bdealer::where(['user_id'=> Auth::id(), 'status' => 'active'])->first();
         return BdealerOrder::where('bdealer_id', $dealer->id)->orderByDesc('id')->get();

    }

    public function getDealerSingleOrderList($id){
        $dealer = BdealerOrderDetail::where('bdealer_order_id', $id)->get();
        return $dealer;
    }

    public function cancelDealerOrderList($id){
        BdealerOrder::where('id', $id)->update(['status'=> 'cancel']);
    }




    public function zone(){
        return Zone::get();
    }


    public function districtInfo(){
        $district = request('zone_id');
        $area = District::where('zone_id', $district)->get();
        return DistrictResource::collection($area);
    }

    public function thanaInfo(){
        $district = request('district_id');
        $area = Thana::where('district_id', $district)->get();
        return ThanaResource::collection($area);
    }

    public function villageInfo(){
        $district = request('thana_id');
        $area = Village::where('thana_id', $district)->get();
        return $area;
    }


    public function bvonDealerApply(Request $request){

        $dealerCount = Bdealer::where('user_id', Auth::id())->count();
        \Log::info($request);

        if($dealerCount == 0){

            if ($request->hasFile('media1')) {
                $image_tmp = $request->file('media1');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'storage/user' . '/' . Auth::id() . '/bdealer' ;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $large_image_path ='storage/user' . '/' . Auth::id() . '/bdealer/' . $filename;
                Image::make($image_tmp)->resize(574, 264)->save($large_image_path);
                $file1 = Auth::id().'/bdealer/'.$filename;
            }else{
                $file1 = null;
            }


            if ($request->hasFile('media2')) {
                $image_tmp = $request->file('media2');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'storage/user' . '/' . Auth::id() . '/bdealer' ;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $large_image_path ='storage/user' . '/' . Auth::id() . '/bdealer/' . $filename;
                Image::make($image_tmp)->resize(574, 264)->save($large_image_path);

                $file2 = Auth::id().'/bdealer/'.$filename;
            }else{
                $file2 = null;
            }


            if ($request->hasFile('media3')) {
                $image_tmp = $request->file('media3');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'storage/user' . '/' . Auth::id() . '/bdealer' ;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $large_image_path ='storage/user' . '/' . Auth::id() . '/bdealer/' . $filename;
                Image::make($image_tmp)->resize(574, 264)->save($large_image_path);
                $file3 = Auth::id().'/bdealer/'.$filename;
            }else{
                $file3 = null;
            }


            if ($request->hasFile('media4')) {
                $image_tmp = $request->file('media4');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'storage/user' . '/' . Auth::id() . '/bdealer' ;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $large_image_path ='storage/user' . '/' . Auth::id() . '/bdealer/' . $filename;
                Image::make($image_tmp)->resize(574, 264)->save($large_image_path);
                $file4 = Auth::id().'/bdealer/'.$filename;
            }else{
                $file4 = null;
            }

            $dealer = new Bdealer();
            $dealer->user_id = Auth::id();
            $dealer->zone_id = $request->zone;
            $dealer->district_id = $request->district;
            $dealer->thana_id  = $request->thana;
            $dealer->village_id  = $request->village;
            $dealer->pic  = $file1;
            $dealer->nid_pic_front  = $file2;
            $dealer->nid_pic_back  = $file3;
            $dealer->ecucation_cert_pic  = $file4;
            $dealer->status = 'pending';
            $dealer->save();

            return response()->json(['message' => 'Your request successfully done!!', 'type' => 'success']);

        }else{
            return response()->json(['message' => 'You are already applied for dealer request !', 'type' => 'error']);
        }










    }











}

