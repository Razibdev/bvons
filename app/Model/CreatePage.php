<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends Model
{
    public function admin(){
        return $this->hasMany(User::class, 'id', 'admin_id');
    }

    public function subAdmin(){
        return $this->hasMany(User::class, 'id','sub_admin_id');
    }
}
