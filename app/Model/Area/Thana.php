<?php

namespace App\Model\Area;

use App\Model\Bdealer\Bdealer;
use App\Model\CommonModel;
use App\UserJob;

class Thana extends CommonModel
{
    public function villages()
    {
        return $this->hasMany(Village::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function area()
    {
        return $this->morphMany(UserJob::class, 'area');
    }

    public function bdealer()
    {
        return $this->hasMany(Bdealer::class);
    }
}
