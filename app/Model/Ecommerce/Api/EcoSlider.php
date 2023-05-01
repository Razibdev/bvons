<?php

namespace App\Model\Ecommerce\Api;

use Illuminate\Database\Eloquent\Model;

class EcoSlider extends Model
{
    protected $fillable = array('id', 'sliders_type','sliders_name','sliders_status','sliders_image');

    public function sliderToProducts(){
        return $this->hasMany('App\Model\Ecommerce\EcoSliderDetail','slider_id','id');
    }

    public function sliderdetailsToProducts(){
        return $this->hasMany('App\Model\Ecommerce\EcoSliderDetail','slider_id','id');
    }
}
