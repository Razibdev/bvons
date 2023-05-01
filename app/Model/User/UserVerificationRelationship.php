<?php

namespace App\Model\User;

use App\User;

trait UserVerificationRelationship {
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
