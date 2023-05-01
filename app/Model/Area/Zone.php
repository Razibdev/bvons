<?php

namespace App\Model\Area;

use App\Model\CommonModel;
use App\UserJob;

class Zone extends CommonModel
{
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function area()
    {
        return $this->morphMany(UserJob::class, 'area');
    }
}
