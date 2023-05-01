<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BvonDoctorRegisterHistory extends Model
{
    public function district(){
        return $this->belongsTo(DistrictOfficer::class, 'district_officer_id');
    }

    public function upazilla(){
        return $this->belongsTo(UpazillaOfficer::class, 'upazilla_officer_id');
    }

    public function field(){
        return $this->belongsTo(FieldOfficer::class, 'field_officer_id	');
    }

//    protected $appends = ['target'];
//    public function getTargetAttribute()
//    {
//        if ($this->district()){
//            return 1500;
//        }elseif($this->upazilla()){
//            return 300;
//        }elseif($this->field()){
//            return 30;
//        }
//    }
}
