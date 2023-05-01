<?php

namespace App\Model\Withdrawal;

use App\User;
use Illuminate\Database\Eloquent\Model;

trait WithdrawalRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
