<?php

namespace App;

use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Ecommerce\EcoMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DealerCart extends Model
{
//    public function media(){
//        return $this->hasMany(EcoMedia::class,'product_id','product_id');
//    }

public function product(){
    $dealer = Bdealer::where('user_id', Auth::id())->first();
    return $this->belongsTo(BdealerProduct::class, 'product_id', 'product_id')->where('bdealer_type_id', $dealer->bdealer_type_id);
}
}
