<?php

namespace App\Model\Ecommerce;

use App\Model\Ecommerce\Api\EcoSubCategory;
use Illuminate\Database\Eloquent\Model;

class EcoBrand extends Model
{
    protected $fillable = array('name', 'brand_image');


    public function sub_category()
    {
        return $this->belongsTo(EcoSubCategory::class);
    }
}


