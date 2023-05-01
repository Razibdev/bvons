<?php

namespace App\Model\User;

use App\Model\CommonModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserVerification extends CommonModel
{
    use UserVerificationRelationship;

    protected $guarded = ['id'];


    public static function totalVerifiedToday()
    {
        return static::where('status', 'accepted')->whereDate('verified_date', Carbon::today())->count();
    }

}
