<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingVoucherTransaction extends Model
{
    protected  $fillable = ['user_id', 'category', 'amount_type', 'amount', 'data', 'message', 'check_date'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
