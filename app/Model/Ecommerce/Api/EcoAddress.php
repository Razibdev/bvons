<?php

namespace App\Model\Ecommerce\Api;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EcoAddress extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
