<?php

namespace App\Model\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use App\Model\Ecommerce\Api\EcoSlider;
use App\Model\Ecommerce\Api\EcoProduct;

class EcoSliderDetail extends Model
{
    protected $guarded = ['id'];

    public function sliders(){

        return $this->belongsTo(EcoSlider::class,'slider_id','id');
    }

    public function products(){

        return $this->belongsTo(EcoProduct::class,'product_id','id');
    }

    public function product()
    {
        return $this->hasOne(EcoProduct::class,'id','product_id');
    }

    public function sliderdetailsToProducts(){
        return $this->belongsTo('App\Model\Ecommerce\Api\EcoProduct');
    }




}
