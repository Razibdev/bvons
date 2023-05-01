<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['media', 'vendor_name'];

    public function getMediaAttribute()
    {
        return "demo product media";
    }
    public function getVendorNameAttribute()
    {
        return "demo vendor name";
    }

}
