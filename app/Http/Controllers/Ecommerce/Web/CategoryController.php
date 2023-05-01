<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoCategory;
use Illuminate\Support\Str;

//use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return EcoCategory::paginate(2);
        $categories =  EcoCategory::all();
        return view('ecommerce.category.index',compact('categories'));
        // $data = EcoCategory::find(2)->sub_categories;
        // return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce.category.create');
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
            'category_name' => 'required|unique:eco_categories|max:255',
            'categories_image' => 'required',
        ]);



        if($request->hasFile('categories_image')){

            $category_id =  EcoCategory::insertGetId([
              'category_name'    =>$request->category_name,
                'url' => Str::slug($request->category_name)
              ]);

              $path = $request->file('categories_image')->store('categories_image');
              echo $path;
              EcoCategory::find($category_id)->update([
                 'categories_image'=> $path
               ]);
                 return back()->with('success', 'Category added Succesfully');;
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
        return EcoCategory::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ecoCategory = EcoCategory::findOrFail($id);
        return view('ecommerce.category.edit', compact('ecoCategory'));
    }

    public function update(Request $request, $id)
    {
        $category = EcoCategory::find($id);
//        echo "<pre>"; print_r($request->all());die;
//        $data= $request->all();

        $request->validate([
            'category_name' => 'required'
        ]);

        $path = null;

        if($request->hasFile('categories_image')) $path = $request->file('categories_image')->store('categories_image');

        $category->update([
            'category_name'    => $request->category_name,
            'categories_image' => $path ?? $category->categories_image

        ]);

        return back()->with('success','Categories updated successfully');
    }



    public function destroy($id)
    {
        $ecoCategory = EcoCategory::findOrFail($id);
        $ecoCategory->delete();

        return 204;
    }
    public function manysubCategory($id)
    {
        $data = EcoCategory::find($id)->sub_categories;
        return $data;
    }
    public function manyproduct($id)
    {
        $data = EcoCategory::find($id)->categpryToProducts;
        return $data;
    }
}
