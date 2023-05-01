<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoSlider;


class SliderController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sliders = EcoSlider::all();
        return view('ecommerce.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();

         $request->validate([
            "sliders_name" => ["required"],
            "sliders_type" => ["required"],
            "percentage" => ["required", "numeric"],
            "sliders_image" => ["required"],
        ]);

        if($request->hasFile('sliders_image')){
            $slider_id =  EcoSlider::insertGetId([
              'sliders_name'    =>$request->sliders_name,
              'sliders_type'    =>$request->sliders_type,
              'percentage'    =>$request->percentage
              ]);

              $path = $request->file('sliders_image')->store('slider');
              EcoSlider::find($slider_id)->update([
                 'sliders_image'=> $path
               ]);
                 return back()->with('success', 'Slider added Succesfully');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EcoSlider $slider)
    {
          return view('ecommerce.sliders.edit',compact('slider'));
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
        //return $request->all();
             $request->validate([
            "sliders_name" => ["required"],
            "sliders_type" => ["required"],
            "percentage" => ["required", "numeric"],
        ]);


    if($request->hasFile('sliders_image')){
           EcoSlider::where('id',$id)->update([
            'sliders_name'    =>$request->sliders_name,
            'sliders_type'    =>$request->sliders_type,
            'percentage'    =>$request->percentage,

          ]);
           $path = $request->file('sliders_image')->store('slider');
          EcoSlider::find($id)->update([
            'sliders_image'=> $path
          ]);
             return redirect()->route('slider.index')
                            ->with('success','sliders updated successfully');
      }
      else{
           EcoSlider::where('id',$id)->update([
            'sliders_name'    =>$request->sliders_name,
            'sliders_type'    =>$request->sliders_type,
            'percentage'    =>$request->percentage,
      ]);
      return redirect()->route('slider.index')
                        ->with('success','sliders updated successfully');
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sliders=EcoSlider::find($id);
        $sliders->delete();
        // $myshops->delete();
        return redirect()->route('slider.index')
                        ->with('success','sliders deleted successfully');
    }


}
