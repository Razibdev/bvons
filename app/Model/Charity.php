<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    public function donor(){
        return $this->hasMany(CharityTransaction::class, 'charity_id');
    }


}
