<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\Ecommerce\EcoBrand;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\Api\EcoCategory;
use DB;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sub_categories = EcoSubCategory::latest()->get();
        return view('ecommerce.subcategory.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EcoCategory::all();
        return view('ecommerce.subcategory.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name'     => 'required|unique:eco_sub_categories|max:255',
            'category_id'           => 'required',
            'subcategories_image'   => 'required',
        ]);
        if($request->hasFile('subcategories_image')) $path = $request->file('subcategories_image')->store('subcategory');
        EcoSubCategory::insertGetId([
            'sub_category_name'    =>$request->sub_category_name,
            'category_id'    =>$request->category_id,
            'url'    => Str::slug($request->categsub_category_nameory),
            'subcategories_image'=> $path
        ]);
        return back()->with('success', 'Subcategory added Succesfully');

    }


    public function show($id)
    {
        return EcoSubCategory::find($id);
    }
    public function edit($id)
    {
        $sub_category = EcoSubCategory::find($id);
        $categories = EcoCategory::all();
        return view('ecommerce.subcategory.edit',compact('sub_category', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $ecoSubCategory = EcoSubCategory::findOrFail($id);
        $request->validate([
            'sub_category_name'     => 'required|max:255|unique:eco_sub_categories,sub_category_name,' . $ecoSubCategory->id,
            'category_id'           => 'required',
        ]);

        $path = null;
        if($request->hasFile('subcategories_image')) $path = $request->file('subcategories_image')->store('subcategory');

        $ecoSubCategory->update([
            'sub_category_name'     => $request->sub_category_name,
            'url'     => Str::slug($request->sub_category_name),
            'category_id'           => $request->category_id,
            'subcategories_image'   => $path ? $path : $ecoSubCategory->subcategories_image
        ]);
        return back()->with('success', 'Subcategory added Succesfully');
    }






    public function destroy($id)
    {
        $ecoSubCategory = EcoSubCategory::findOrFail($id);
        $ecoSubCategory->delete();

        return 204;
    }




    public function manyproduct($id)
    {
        $data = EcoSubCategory::find($id)->subcategpryToProducts;
        return $data;
    }
    public function subcat($id)
    {
         $sub = DB::table('eco_sub_categories')->where('category_id',$id)->get();
        return response()->json($sub);
    }
    public function size($id)
    {
        $sub_cat = EcoSubCategory::find($id);
       // return $id;
          $sub = DB::table('eco_sizes')->where('subcategories_id',$id)->get();
             return response()->json(["size" => $sub, "brands" => $sub_cat->brands]);
    }



    public function categoryUrl(Request $request){
        EcoCategory::where('id', $request->id)->update(['url' => Str::slug($request->category_url)]);
        return response()->json();

    }


    public function subCategoryUrl(Request $request){
        EcoSubCategory::where('id', $request->id)->update(['url' => Str::slug($request->sub_url)]);
        return response()->json();

    }

    public function brandUrl(Request $request){
        EcoBrand::where('id', $request->id)->update(['url' => Str::slug($request->band_url)]);
        return response()->json();

    }






}
