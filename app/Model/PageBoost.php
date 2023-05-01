<?php

namespace App\Model;

use App\BoostType;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PageBoost extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function page(){
        return $this->belongsTo(CreatePage::class);
    }

    public function boost(){
        return $this->belongsTo(BoostType::class, 'boost_type_id', 'id');
    }




}
