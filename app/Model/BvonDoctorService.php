<?php

namespace App\Model;

use App\Model\Area\District;
use App\Model\Area\Thana;
use Illuminate\Database\Eloquent\Model;

class BvonDoctorService extends Model
{
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id')->select('id', 'name');
    }

    public function thana(){
        return $this->belongsTo(Thana::class, 'thana_id', 'id')->select('id', 'name');
    }

}
