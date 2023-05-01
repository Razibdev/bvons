<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EcoProductCollection as EcoProductResource;
use App\Model\Ecommerce\Api\EcoProduct;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoSlider;
use DB;
use App\Http\Resources\Sliders as EcoSliderResource;

class SliderController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EcoSlider $sliders)
    {
        // $address = EcoSlider::where('sliders_status', 2)->get()->makeHidden(['updated_at', 'created_at']);
        // return $address;
        //  $sliders = DB::table('eco_sliders')
        // ->select('id', 'sliders_type','dynamic_id'+'ihb', 'sliders_status', 'sliders_image')
        // ->get();


        return  EcoSlider::where('sliders_status', 1)->get();
       // return $sliders;
    }

    public function getProducts($id)
    {

        $slider = EcoSlider::where('id', $id);

        if($slider->count() < 1) return response()->json(["error" => "invalid slider id"], 422);


        $product_ids = $slider->first()->sliderToProducts()->get()->pluck('product_id');


        if($sub_cat_id = \request()->query('sub_cat_id')) {
            $products = EcoProduct::whereIn('id', $product_ids)->where('subcategory_id', $sub_cat_id)->orderBy('updated_at', 'desc')->paginate(10);
        } else {
            $products = EcoProduct::whereIn('id', $product_ids)->orderBy('updated_at', 'desc')->paginate(10);
        }



        return EcoProductResource::collection($products);


    }

}
