<?php

namespace App\Model\PaymentMethod;

use App\Model\CommonModel;
use App\User;

trait PaymentMethodRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
