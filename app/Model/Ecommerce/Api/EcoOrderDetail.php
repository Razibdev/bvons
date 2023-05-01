<?php

namespace App\Model\Ecommerce\Api;

use App\Model\Ecommerce\EcoMedia;
use Illuminate\Database\Eloquent\Model;

class EcoOrderDetail extends Model
{
    public $table= 'eco_order_details';
    protected $guarded = ["id"];

    public function order()
    {
        return $this->belongsTo(EcoOrder::class);
    }

    public function products()
    {
        return $this->hasOne(EcoProduct::class, 'id', 'product_id')->withTrashed();
    }
    public function product()
    {
        return $this->hasOne(EcoProduct::class, 'id', 'product_id')->select('id', 'product_name');
    }

    public function media(){
        return $this->hasOne(EcoMedia::class, 'product_id', 'product_id');
    }


    protected $dates = [
        'created_at',
        'date'
    ];

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y | H:i:s:a');
    }

    protected $appends = ['formatted_date'];




}
