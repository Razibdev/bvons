<?php

namespace App\Model\Area;

use App\Model\Bdealer\Bdealer;
use App\Model\CommonModel;
use App\UserJob;


class Village extends CommonModel
{
    public function area()
    {
        return $this->morphMany(UserJob::class, 'area');
    }

    public function bdealer()
    {
        return $this->hasMany(Bdealer::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

}
