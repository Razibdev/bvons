<?php
namespace App\Model\User;

use App\User;

trait UserVerificationDetailsRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

