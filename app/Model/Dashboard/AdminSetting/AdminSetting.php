<?php

namespace App\Model\Dashboard\AdminSetting;

use App\Model\CommonModel;

class AdminSetting extends CommonModel
{
    protected $guarded = ["id"];


    public static function getSetting($setting_name) {
        $setting = self::where("setting_name", $setting_name)->first();
        if(!$setting) return "invalid setting name";
        if($setting->setting_value != null || $setting->setting_value != "") {
            return $setting->setting_value;
        } else {
            return $setting->setting_default_value;
        }
    }
}
