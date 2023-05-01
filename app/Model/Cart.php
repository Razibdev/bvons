<?php

namespace App\Model;

use App\Model\Ecommerce\Api\EcoProduct;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function product(){
        return $this->belongsTo(EcoProduct::class);
    }
}
