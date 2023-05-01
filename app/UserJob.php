<?php

namespace App;

use App\Model\CommonModel;

class UserJob extends CommonModel
{
    public function areaable()
    {
        return $this->morphTo(__FUNCTION__, 'area_type', 'area_id');
    }
    public function job_type()
    {
        return $this->belongsTo(UserJobType::class, 'user_job_type_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
