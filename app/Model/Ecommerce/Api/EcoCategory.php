<?php

namespace App\Model\Ecommerce\Api;

use Illuminate\Database\Eloquent\Model;

class EcoCategory extends Model
{
    protected $fillable = array('id', 'category_name','categories_image');

    public function sub_categories()
    {
        return $this->hasMany('App\Model\Ecommerce\Api\EcoSubCategory','category_id','id');
    }
    public function categpryToProducts()
    {
        return $this->hasMany('App\Model\Ecommerce\Api\EcoProduct','category_id','id');
    }

    public function brand(){
        return $this->hasMany('App\Model\Ecommerce\EcoBrand','sub_category_id');
    }

    public function products()
    {
        return $this->hasMany(EcoProduct::class, 'category_id','id');
    }


}

