<?php

namespace App\Model\Ecommerce;

use App\EcoVendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EcoShop extends Model
{
    use SoftDeletes;
    protected $fillable = array('id', 'shop_name','shop_address','status','vendor_id','shop_image', 'priority');
    public const  ACTIVE_SHOP = 1;

    public function shopToProducts()
    {
        return $this->hasMany('App\Model\Ecommerce\Api\EcoProduct','shop_id','id');
    }

    public function vendor() {
        return $this->belongsTo(EcoVendor::class);
    }

    public static function real()
    {
        return static::where('status', 1)->orderBy('priority', 'desc');
    }
}

