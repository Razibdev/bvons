<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoProduct;
use App\HotProducts;
use DB;
class HotProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = EcoProduct::all();
        return view('ecommerce.hotproducts.create',compact('products'));
    }
    public function show()
    {
        //   $data =  DB::table('hot_products')
        //      ->join('eco_products', 'product_id.id', '=', 'eco_products.id')
        //     // ->join('slider_detaills', 'eco_sliders.id', '=', 'slider_detaills.slider_id')
        //     // ->join('eco_shops', 'eco_products.id', '=', 'eco_products.id')
        //      ->select('hot_products.*','eco_products.*')
        //     ->get();
$products =  DB::table('hot_products')
             ->join('eco_products', 'hot_products.product_id', '=', 'eco_products.id')
             ->join('eco_shops', 'eco_products.shop_id', '=', 'eco_shops.id')
             ->select('hot_products.*','eco_products.*','eco_shops.*')
            ->get();

        //$products = HotProducts::all();
        return view('ecommerce.hotproducts.index',compact('products'));
    }

     public function addCoin($id,$coin)
    {
        // return $priority;

        /*if(HotProducts::where('product_id', $id )->exists()){
            $hotproducts = HotProducts::where('product_id', $id )->first();

            $hotproductsID =  $hotproducts->id;

            $lastcoin =  $hotproducts->coin;
            $allCoin = $coin+$lastcoin;
             HotProducts::where('id',$hotproductsID)->update([
            'coin'    => $allCoin,
            ]);
            return back()->with('success', 'Coin Updated Succesfully');
        }
        else{
           HotProducts::insert([
             'product_id'    =>$id,
             'coin'    =>$coin,
             ]);
        }*/

        $updated = EcoProduct::find($id)->update([
            "product_promote" => $coin
        ]);

        if($updated) {
            return back()->with('success', 'Coin Added Succesfully');
        }

    }
}
