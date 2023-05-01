<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Designation;
use App\Model\DesignationHistory;
use App\Model\DesignationSalaryAchievement;
use App\Model\DesignationSetting;
use App\Model\DesignationUsercount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DesignationController extends Controller
{
    public function getSalarySetting(){
       $setting = AdminSetting::where('setting_name', 'Designation Setting')->first();
       $setting = explode(",", $setting->setting_value);
        return $setting;
    }

    public function getSalaryDaily(){
        $data = Designation::whereMonth('created_at', Carbon::now()->month)
            ->get();
        return $data;
    }

    public function getSalaryUserCount(){
        $data = DesignationUsercount::whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
        return $data;
    }
//Carbon::now()->subMonth()->month

    public function getSalaryUserTotal(){
        $data = DesignationSetting::whereMonth('created_at', Carbon::now()->month)->get();
        return $data;
    }

    public function getSalaryUserAchievement(){
        $data = DesignationSalaryAchievement::whereMonth('created_at', Carbon::now()->subMonth()->month)->get();
        return $data;
    }


    public function getSalaryUserHistory(){
        return DesignationHistory::all();
    }
}
