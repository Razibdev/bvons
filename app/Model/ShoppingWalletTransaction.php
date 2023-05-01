<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingWalletTransaction extends Model
{
    protected  $fillable = ['user_id', 'category', 'amount_type', 'amount', 'data', 'message', 'check_date'];

}
