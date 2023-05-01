<?php

namespace App\Model\Ecommerce;

use App\Model\Ecommerce\Api\EcoOrder;
use Illuminate\Database\Eloquent\Model;

class EcoPayment extends Model
{
    protected $guarded = ["id"];
    public function order()
    {
        return $this->belongsTo(EcoOrder::class);
    }
}
