<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\EcoSliderDetail;
use DB;
use App\Http\Resources\SliderDetailsCollection as SliderDetailsResource;

class SliderDetailsController extends Controller
{
    // public function sliderToproduct($id)
    // {
    //   return  EcoSlider::find($id)->sliderToProducts;
    // }
    public function sliderToproduct($id) {
            //   $data =  DB::table('eco_sliders')->where('eco_sliders.id', $id)
            //  ->join('eco_products', 'eco_sliders.id', '=', 'eco_products.id')
            // ->join('slider_detaills', 'eco_sliders.id', '=', 'slider_detaills.slider_id')
            // ->join('eco_shops', 'eco_products.id', '=', 'eco_products.id')
            //  ->select('eco_sliders.*','eco_products.*','eco_shops.*')
            // ->paginate(2);

             $data =  EcoSliderDetail::all();
            return $data;



    }
}


//sliderToProducts
