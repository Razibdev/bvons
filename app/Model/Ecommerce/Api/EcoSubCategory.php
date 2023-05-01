<?php

namespace App\Model\Ecommerce\Api;

use App\Model\Ecommerce\EcoBrand;
use Illuminate\Database\Eloquent\Model;


class EcoSubCategory extends Model
{
    protected $fillable = array('id', 'sub_category_name','category_id','subcategories_image');


    public function categories(){
        return $this->hasMany('App\Model\Ecommerce\Api\EcoCategory','id','id');
    }
    public function subcategpryToProducts()
    {
        return $this->hasMany('App\Model\Ecommerce\Api\EcoProduct','subcategory_id','id');
    }
    public function single_categories()
    {
        return $this->belongsTo('App\Model\Ecommerce\Api\EcoCategory','category_id','id');
    }

    public function brand()
    {
        return $this->hasMany(EcoBrand::class, 'sub_category_id', 'id');
    }
}
