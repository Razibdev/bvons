<?php

namespace App\Http\Controllers\Ecommerce\Api;

use App\Http\Controllers\Controller;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Ecommerce\Api\EcoSlider;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\EcoShop;
use Illuminate\Support\Arr;
use Validator;
use DB;
use App\Http\Resources\EcoProductCollection as EcoProductResource;
use App\Http\Resources\BdealerProductCollection as BdealerProductResource;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        request()->validate([
            'slider_id' => 'numeric|nullable',
            'sub_cat_id' => 'numeric|nullable',
            'shop_id' => 'numeric|nullable',
        ]);


        $slider_id = request()->query('slider_id') ?? null;
        $sub_cat_id = request()->query('sub_cat_id') ?? null;
        $sort_by = request()->query('sort_by') ?? null;
        $search = request()->query('search') ?? null;
        $slider_type = request()->query('slider_type') ?? null;
        $shop_id = request()->query('shop_id') ?? null;
        $brand_id = request()->query('brand_id') ?? null;
        $coin = request()->query('coin') ?? null;





        $products = [];
        $price =  auth()->check() && auth()->user()->check_user_is_verified() ? 'premium_price' : 'user_price';

        if($sort_by === null) {
            if($coin == 1) {
                $products = EcoProduct::orderBy('product_promote', 'desc');
            } else {
                $products = EcoProduct::orderBy('updated_at', 'desc');
            }
        } else {
            switch ($sort_by) {
                case "name_asc" :
                    $products = EcoProduct::orderBy('product_name', 'asc');
                    break;
                case "name_desc" :
                    $products = EcoProduct::orderBy('product_name', 'desc');
                    break;
                case "price_asc" :
                    $products = EcoProduct::orderBy($price, 'asc');
                    break;
                case "price_desc" :
                    $products = EcoProduct::orderBy($price, 'desc');
                    break;
            }
        }


        if($slider_id || $slider_type) {
            $condition = [];
            if($slider_id) {
                $condition["id"] = $slider_id;
            }
            if($slider_type) {
                $condition["sliders_type"] = $slider_type;
            }
            $slider = EcoSlider::where($condition);
            if($slider->count() < 1) return response()->json(["error" => "invalid slider id"], 422);
            $product_ids = [];
            foreach ($slider->get() as $s) {
                $product_ids[] = $s->sliderToProducts()->get()->pluck('product_id');
            }
            $product_ids = Arr::collapse($product_ids);
        }

        if($slider_id || $slider_type) {
            $products->whereIn('id', $product_ids);
        }
        if($shop_id) {
            $products->where('shop_id', $shop_id);
        }
        if($sub_cat_id) {
            $products->where('subcategory_id', $sub_cat_id);
        }

        if($brand_id) {
            $products->where('brand_id', $brand_id);
        }

        if($brand_id) {
            $products->where('brand_id', $brand_id);
        }

        if($coin == 1) {
            $products->where('product_promote', '>', 0);

        }


        if($search) {
            $products->where(function($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%');
                $q->orWhere('description', 'like', '%' . $search . '%');
            });
        }



        $products = $products->where([
            'product_permision' => 'approved',
            'product_visibility' => 1
        ])->paginate(18);


        return  EcoProductResource::collection($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        //
    }


    public function manyproduct($id)
    {
        $data = EcoCategory::find($id)->categpryToProducts;
        return $data;
    }
    public function hotProducts()
    {
        // echo "Sdfg";
        $data = EcoProduct::where('product_promote', 'yes')->paginate(5);
        return $data;
    }
    public function search(Request $request)
    {
        // echo "Sdfg";
        $variable = $request->my;
        // $term = $request->input('data');
        $filter = DB::table('eco_products')->where('product_name','LIKE','%'.$variable.'%')->get();

        // $term = 'SSENSE';
        //  $query = EcoProduct::where('product_name', 'LIKE', '%' . $term . '%');
        return $filter;

    }

    public function dealerProduct(Request $request)
    {
        $products = EcoProduct::join('bdealer_products', 'eco_products.id', '=', 'bdealer_products.product_id')
            ->bdealerProduct()
            ->where('bdealer_products.bdealer_type_id', auth()->user()->b_dealer->type->id)
            ->where('category_id', $request->query('cat_id'))
            ->select(
                "eco_products.id as id",
                "bdealer_products.id as bdealer_id",
                "product_name",
                "description",
                "product_size",
                "product_promote",
                "product_permision",
                "product_discount",
                "product_visibility",
                "product_quantity",
                "production_price",
                "bvon_price",
                "store_amount",
                "sr_amount",
                "premium_price",
                "user_price",
                "can_use_cashback",
                "vendor_id",
                "shop_id",
                "category_id",
                "subcategory_id",
                "eco_products.created_at",
                "eco_products.updated_at",
                "brand_id",
                "product_model",
                "show_to_dealers",
                "product_id",
                "bdealer_type_id",
                "purchase_price",
                "minimum_quantity"
            )
            ->paginate(10);
        return BdealerProductResource::collection($products);

    }

    public function dealerProductDetails($id, Request $request){
        $products = EcoProduct::join('bdealer_products', 'eco_products.id', '=', 'bdealer_products.product_id')
            ->bdealerProduct()
            ->where('bdealer_products.bdealer_type_id', auth()->user()->b_dealer->type->id)
            ->where('eco_products.id', $id)
            ->select(
                "eco_products.id as id",
                "bdealer_products.id as bdealer_id",
                "product_name",
                "description",
                "product_size",
                "product_promote",
                "product_permision",
                "product_discount",
                "product_visibility",
                "product_quantity",
                "production_price",
                "bvon_price",
                "store_amount",
                "sr_amount",
                "premium_price",
                "user_price",
                "can_use_cashback",
                "vendor_id",
                "shop_id",
                "category_id",
                "subcategory_id",
                "eco_products.created_at",
                "eco_products.updated_at",
                "brand_id",
                "product_model",
                "show_to_dealers",
                "product_id",
                "bdealer_type_id",
                "purchase_price",
                "minimum_quantity"
            )->with('media')->withTrashed()->first();

        return  $products ? BdealerProductResource::make($products) : null;
    }
}
