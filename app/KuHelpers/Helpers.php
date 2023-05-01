<?php
namespace App\KuHelpers;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Mockery\Exception;

class Helpers {
    public static function greeting() {
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Good morning";
        } else
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                return "Good afternoon";
            } else
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    return "Good evening";
                } else
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        return "Good night";
                    }
    }
    public static function generate_random_code($model, $column_name, $length = 16) {
        if($length > 16) $length = 16;
        $random_string = substr(md5(Str::random()),0,$length);
        if($model::where($column_name, $random_string)->count() > 0) {
            return static::generate_random_code($model, $column_name, $length);
        } else {
            return $random_string;
        }
    }
    public static function distanceInKmBetweenEarthCoordinates($lat1, $lon1, $lat2, $lon2) {
        $earthRadiusKm = 6371;
        $dLat = deg2rad($lat2-$lat1);
        $dLon = deg2rad($lon2-$lon1);
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $a = sin($dLat/2) * sin($dLat/2) + sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadiusKm * $c;
    }
    public static function validateCommaSeperatedNumericString($comma_seperated_numeric_string, $return_options = "boolean")
    {
        $numeric_string_arrays = explode(",", $comma_seperated_numeric_string);
        $numeric_string_data_ok = true;
        if(count($numeric_string_arrays) > 0) {
            foreach ($numeric_string_arrays as $numeric_string_array) {
                if(!is_numeric( $numeric_string_array )) {
                    $numeric_string_data_ok = false;
                    break;
                }
            }
        } else {
            $numeric_string_data_ok = false;
        }

        if($numeric_string_data_ok) {
            if(strtolower($return_options) === "boolean") return $numeric_string_data_ok;
            else if(strtolower($return_options) === "array") return $numeric_string_arrays;
            else throw new Exception(__FUNCTION__ . "($comma_seperated_numeric_string, $return_options) Invalid return options");
        }

        return $numeric_string_data_ok;
    }
    public static function hourMinuteToMinute ($h, $m) {
        return $h * 60 + $m;
    }
    public static function giveRegistrationBonus($referral_user) {
        static $level = 0;
        $registration_bonus_setting = AdminSetting::getSetting('User Registration Bonus');
        $registration_bonus = array_map('floatval', explode(',', $registration_bonus_setting));
        $limit = count($registration_bonus);
        if($level >= $limit) return;
        if(!$referral_user->has_job()) return;
        $referral_user->transactions()->create([
            "category" => "registration bonus",
            "amount_type" => "c",
            "amount" => $registration_bonus[$level],
            "data" => "",
            "message" => ucfirst("you get registration bonus level {$level}")
        ]);

        $level++;
        $myReferrer = User::validateReferralId($referral_user->referred_by);
        if(!$myReferrer) return;
        static::giveRegistrationBonus($myReferrer);
    }
    public static function send_push_notification($data)
    {
        try {
            $factory = (new Factory)->withServiceAccount(Storage::disk('db')->path('firebase/firebase_credentials.json'));
            $messaging = $factory->createMessaging();
            $msg = CloudMessage::withTarget('token', $data["fcm_token"])->withNotification(Notification::create($data["title"], $data["body"]));
            if(array_key_exists("data", $data)) {$msg->withData($data);}
            return $messaging->send($msg);
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function number_format_short( $n, $precision = 1 ) {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ( $precision > 0 ) {
            $dotzero = '.' . str_repeat( '0', $precision );
            $n_format = str_replace( $dotzero, '', $n_format );
        }

        return $n_format . $suffix;
    }


    public static function product_single_media($media)
    {
        if(gettype($media) === "array" && count($media)) {
            return url('storage/' . collect($media)->first()->product_image);
        } else if(($media instanceof Collection) && $media->count()) {
            url('storage/' . $media->first()["product_image"]);
        } else {
            return Storage::disk('img_not_found')->url('/pro_img_not_found.png');
        }
    }

}



