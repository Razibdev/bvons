<?php

namespace App\Model\Bcourier;

use App\Model\CommonModel;

class BcoRequest extends CommonModel
{
    // Status List
    //-> pending (default)
    //-> accepted
    //-> cancelled

    public function delivery_boy()
    {
        return $this->belongsTo(BcoDeliveryBoy::class, 'bco_delivery_boy_id');
    }

    public function percel()
    {
        return $this->belongsTo(BcoPercel::class, 'bco_percel_id');
    }
}
