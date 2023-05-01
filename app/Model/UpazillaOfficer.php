<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UpazillaOfficer extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'referral_id', 'profile_pic', 'phone', 'email');
    }
}
