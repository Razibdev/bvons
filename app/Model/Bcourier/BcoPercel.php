<?php

namespace App\Model\Bcourier;

use App\Model\CommonModel;
use App\User;

class BcoPercel extends CommonModel
{
    // Status List
    //-> waiting (default)
    //-> booked
    //-> ongoing
    //-> delivered
    //-> cancelled
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function percel_request()
    {
        return $this->hasMany(BcoRequest::class);
    }

    public function type()
    {
        return $this->belongsTo(BcoPercelType::class, 'bco_percel_type_id');
    }
}
