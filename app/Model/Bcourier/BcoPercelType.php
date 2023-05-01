<?php

namespace App\Model\Bcourier;

use App\Model\CommonModel;

class BcoPercelType extends CommonModel
{
    public function percel()
    {
        return $this->hasMany(BcoPercel::class);
    }
}
