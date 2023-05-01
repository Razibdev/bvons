<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\Ecommerce\Api\EcoSubCategory;
use Illuminate\Http\Request;
use App\Model\Ecommerce\EcoBrand;
use DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brands = EcoBrand::all();
        return view('ecommerce.brands.index',compact('brands'));


        // return view('ecommerce.shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.brands.create')->with(["sub_categories" => EcoSubCategory::all()]);
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
            "name" => ["required"],
            "brand_image" => ["required"],
            "subcategory_id" => ["required"],
        ]);

        if($request->hasFile('brand_image')){
            $brand_id =  EcoBrand::insertGetId([
              'name'    =>$request->name,
              'sub_category_id'    =>$request->subcategory_id,
              ]);

              $path = $request->file('brand_image')->store('brand');
              EcoBrand::find($brand_id)->update([
                 'brand_image'=> $path
               ]);
                 return back()->with('success', 'Brand added Succesfully');
            }
            else{
                EcoBrand::create([
                    'name'    =>$request->name,
              ]);
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
    public function edit(EcoBrand $brand)
    {
        return view('ecommerce.brands.edit',compact('brand'));

            // $shop_info = EcoShop::findOrFail($id);
            // return view('ecommerce.shops.edit',compact('shop_info'));
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
        $request->validate([
            "name" => ["required"],
        ]);

    if($request->hasFile('brand_image')){
       EcoBrand::where('id',$id)->update([
       'name'    =>$request->name,
      ]);
       $path = $request->file('brand_image')->store('brand');
      EcoBrand::find($id)->update([
        'brand_image'=> $path
      ]);
      }
      else{
          EcoBrand::where('id',$id)->update([
            'name'    =>$request->name,
      ]);
      }

        return redirect()->route('brands.index')
                        ->with('success','Brands updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $ecobrands=EcoBrand::find($id);
        $ecobrands->delete();

        // $myshops->delete();

        return redirect()->route('brands.index')
                        ->with('success','Brand deleted successfully');
    }

}
