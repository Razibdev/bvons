<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MarchantTransaction extends Model
{
    protected $fillable = ['user_id', 'category', 'amount_type', 'amount', 'message', 'check_date', 'data', 'referral_id'];
}
