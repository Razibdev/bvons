<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CharityTransaction extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(){
        return $this->belongsTo(Charity::class, 'charity_id');
    }


}
