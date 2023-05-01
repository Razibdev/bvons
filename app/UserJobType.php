<?php

namespace App;

use App\Model\CommonModel;

class UserJobType extends CommonModel
{
    public function jobs()
    {
        return $this->hasMany(UserJob::class);
    }
}
