<?php

namespace App\Model;

use App\Model\Area\District;
use App\Model\Area\Thana;
use App\RelationMember;
use App\User;
use Illuminate\Database\Eloquent\Model;

class DoctorMember extends Model
{
    public function officer(){
        return $this->belongsTo(User::class, 'referral_id', 'referral_id')->select('name', 'id', 'referral_id', 'phone', 'profile_pic', 'id_card');
    }
    public function district(){
        return $this->belongsTo(District::class, 'district_id')->select('name', 'id');
    }

    public function thana(){
        return $this->belongsTo(Thana::class, 'thana_id')->select('name', 'id');
    }


    public function members(){
        return $this->hasMany(RelationMember::class, 'member_id');
    }
}
