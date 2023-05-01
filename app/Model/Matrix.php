<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    protected $guarded = [];
    protected  $fillable = ['user_id', 'referral_id', 'parent_id', 'left_position', 'middle_position', 'right_position'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
