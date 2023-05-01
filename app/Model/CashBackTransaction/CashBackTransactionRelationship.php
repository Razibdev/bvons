<?php

namespace App\Model\CashBackTransaction;

use App\Model\CommonModel;
use App\User;

trait CashBackTransactionRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
