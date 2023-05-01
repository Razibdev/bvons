<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoSlider;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoSliderDetail;
use DB;
class SliderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = EcoSlider::all();
        return view('ecommerce.sliders.slider_to_product_show',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sliders = EcoSlider::all();
        $products = EcoProduct::all();
        return view('ecommerce.sliders.slider_to_product_add',compact('sliders','products'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
            'slider_id' => 'required',
            'product_id' => 'required|unique:eco_slider_details',
        ]);
            EcoSliderDetail::insertGetId([
              'slider_id'    =>$request->slider_id,
              'product_id'    =>$request->product_id,
              ]);   
        return redirect()->route('sliderDetails.index')
                        ->with('success','Slider Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $sliders = EcoSlider::findOrFail($id)->sliderdetailsToProducts;

        //return  $sliders;



           //$data =  DB::table('eco_sliders')->get();
             $data =  DB::table('eco_sliders')->where('eco_sliders.id', $id)
            ->join('eco_slider_details', 'eco_sliders.id', '=', 'eco_slider_details.slider_id')
            ->join('eco_products', 'eco_slider_details.product_id', '=', 'eco_products.id')
             ->select( 'eco_slider_details.*','eco_sliders.*', 'eco_products.*')
            ->get();

            return $data;
    }
            //  ->join('eco_products', 'eco_sliders.products.id', '=', 'eco_products.id')

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EcoSliderDetail::where('product_id', $id)->delete();
        //return $id;
        //  $ecoshops=EcoSliderDetail::find($id);  
        // $ecoshops->delete();
         return back();
    }
}
// product_id