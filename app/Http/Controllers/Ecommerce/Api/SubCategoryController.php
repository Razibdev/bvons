<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\Api\EcoCategory;
use DB;
use App\Http\Resources\SubCategoryCollection as SubCategoryResource;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $data =  EcoSubCategory::all();
           // return SubCategoryResource::collection($data);
        //return EcoSubCategory::all();
        // $data = EcoSubCategory::with('categories')->get();
         //return $data;
    }


    public function manyproduct($id)
    {
        // $data = EcoSubCategory::find($id)->subcategpryToProducts;
        $data =  DB::table('eco_sub_categories')->where('eco_sub_categories.id', $id)
            ->join('eco_products', 'eco_sub_categories.id', '=', 'eco_products.subcategory_id')
            ->join('eco_shops', 'eco_sub_categories.id', '=', 'eco_shops.id')
             //->select('eco_sub_categories.*', 'eco_sub_categories.id')
            ->get();
        return $data;
    }
    public function manysubCategory($id)
    {
        $data = EcoCategory::find($id)->sub_categories;
        return $data;
    }

    public function getBrand(EcoSubCategory $id)
    {
        return $id->brands;
    }

    public function brand(){
        return $this->hasMany('App\Model\Ecommerce\EcoBrand','sub_category_id');
    }

}
