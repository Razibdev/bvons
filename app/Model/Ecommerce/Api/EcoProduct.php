<?php

namespace App\Model\Ecommerce\Api;

use App\EcoVendor;
use App\Http\Resources\EcoProductCollection as EcoProductResource;
use App\Model\Bdealer\BdealerProduct;
use App\Model\CommonModel;
use App\Model\Ecommerce\EcoBrand;
use App\Model\Ecommerce\EcoSliderDetail;
use Illuminate\Database\Eloquent\Model;
use App\Model\Ecommerce\EcoShop;
use App\Model\Ecommerce\EcoMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Scout\Searchable;

class EcoProduct extends CommonModel
{
    use SoftDeletes;
//    use Searchable;



/*    public function searchableAs()
    {
        return 'product_name';
    }

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'description' =>  $this->description,
            'product_size' => "somsize",
            'product_discount' => $this->product_discount,
            'product_quantity' => $this->product_quantity,
            'premium_price' => $this->premium_price,
            'user_price' => $this->user_price,
            'shop' => [
                "id" => $this->shop->id,
                "name" => $this->shop->shop_name,
            ],
            'product_media' => $this->media,
            'category' => [
                "id" => $this->category->id,
                "name" => $this->category->category_name,
            ],
            'subcategory' => [
                "id" => $this->sub_category->id,
                "name" => $this->sub_category->sub_category_name,
            ],
            'slider' => $this->get_slider() ? [
                "id" => $this->get_slider()->id,
                "name" => $this->get_slider()->sliders_name
            ] : null,
            'USEABLE_CASHBACK_PERCENT' => $this->get_slider() ? 0 : EcoProduct::USEABLE_CASHBACK_PERCENT,

        ];

        // Customize array...

        return $array;
    }*/



    public const USEABLE_CASHBACK_PERCENT = 10;



    public function shop(){
        return $this->belongsTo(EcoShop::class);
    }
    public function category(){
        return $this->belongsTo(EcoCategory::class);
    }

    public function sub_category(){
        return $this->belongsTo(EcoSubCategory::class, 'subcategory_id');
    }
    public function subCategory(){
        return $this->belongsTo(EcoSubCategory::class,'subcategory_id','id');
    }
    public function media(){
        return $this->hasOne(EcoMedia::class,'product_id','id')->select('id', 'product_image', 'product_id');
    }

    public function brand(){
        return $this->hasMany(EcoBrand::class,'sub_category_id','id');
    }

    public function orderToProduct(){
        return $this->hasMany('App\Model\Ecommerce\Api\EcoOrderDetail','order_id','id');
    }
    public function shops(){
        return $this->belongsTo(EcoShop::class,'shop_id','id');
    }
    public function brands(){
        return $this->belongsTo(EcoBrand::class,'brand_id','id');
    }
    public static function cartCount(){
        if(Auth::check()){
            //User is logged in; We will use auth
            $user_phone = Auth::user()->phone;
            $cartCount = DB::table('carts')->where('user_phone', $user_phone)->sum('quantity');
        }else{
            //User is not logged in we will use session
            $session_id = Session::get('session_id');
            $cartCount = DB::table('carts')->where('session_id', $session_id)->sum('quantity');
        }
        return $cartCount;
    }


    public function product_slider_details()
    {
        return $this->hasOne(EcoSliderDetail::class, 'product_id', 'id');
    }
    public function get_slider()
    {
        if($campaign = $this->product_slider_details) {
            return $campaign->sliders;
        }
        return null;
    }

    public function product_under_slider()
    {
        $slider = $this->get_slider();
        if($slider && $slider->sliders_status == 1) {
            return $slider;
        }

        return false;
    }


    public function vendor()
    {
        return $this->belongsTo(EcoVendor::class);
    }

    public function bdealerProductPrice()
    {
        return $this->hasMany(BdealerProduct::class, 'product_id', 'id');
    }

    public function hasBdealerProductPrice()
    {
        return $this->bdealerProductPrice()->count() ? true : false;
    }

    public function scopeApprovedVisible()
    {
        return $query->where([
            'product_permision' => 'approved',
            'product_visibility' => 1
        ]);
    }

    public function scopeBdealerProduct($query)
    {
        return $query->where([
            'show_to_dealers' => 1,
            'product_permision' => 'approved',
            'product_visibility' => 1
        ]);
    }

}


