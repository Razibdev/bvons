<?php

namespace App\Model;

use App\RelationMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DPrescription extends Model
{
    protected $casts = [
        'created_at'  => 'datetime:Y-m-d | H:i:s',
        'updated_at' => 'datetime:Y-m-d',
    ];
    protected $fillable = [
         'message'
    ];

    public function user(){
        return $this->belongsTo(DoctorMember::class , 'user_id')->select('name', 'id');
    }

    public function doctor(){
        return $this->belongsTo(BDoctor::class, 'doctor_id')->select('name', 'id');
    }

    public function submember(){
        return $this->belongsTo(RelationMember::class, 'sub_member', 'id');
    }

//    public function getshortmessageAttribute()
//    {
//        return Str::limit($this->message, 50 );
//    }

}
