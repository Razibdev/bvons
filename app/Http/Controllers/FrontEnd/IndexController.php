<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoBrand;
use App\Model\Ecommerce\EcoShop;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){

        $shops = EcoShop::get();
        $brands = EcoBrand::inRandomOrder()->limit(64)->get();
        $products = EcoProduct::where('deleted_at', NULL)->orderByDesc('id')->paginate(16);

        if($request->ajax()){
            $view = view('data', compact('products'))->render();
            return response()->json(['html'=> $view]);
        }

        return view('index', compact('shops', 'brands', 'products'));
    }


    public function secondIndex(){
        return view('second');
    }

}
