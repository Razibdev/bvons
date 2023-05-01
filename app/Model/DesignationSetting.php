<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DesignationSetting extends Model
{
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
