<?php

namespace App\Model\Area;

use App\Model\CommonModel;
use App\UserJob;

class District extends CommonModel
{
    public function zone()
    {
        $this->belongsTo(Zone::class);
    }
    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function area()
    {
        return $this->morphMany(UserJob::class, 'area');
    }
}
