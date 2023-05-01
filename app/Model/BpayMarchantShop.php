<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BpayMarchantShop extends Model
{
    public function category(){
        return $this->belongsTo(BpayCategory::class, 'category_id');
    }
}
