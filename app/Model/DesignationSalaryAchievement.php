<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DesignationSalaryAchievement extends Model
{
    protected $casts = [
        'created_at'  => 'date:d/m/Y',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
