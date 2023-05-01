<?php

namespace App\App\Model;

use App\UserRelationship;
use Illuminate\Database\Eloquent\Model;

class ComisionBonus extends Model
{
    use UserRelationship;
    protected  $fillable = [];
    protected $guarded = [];

    protected $dates =['daily_date'];


}
