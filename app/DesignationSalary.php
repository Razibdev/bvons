<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationSalary extends Model
{
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
