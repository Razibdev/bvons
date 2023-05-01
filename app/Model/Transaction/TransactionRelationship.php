<?php
namespace App\Model\Transaction;
use App\User;
trait TransactionRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
