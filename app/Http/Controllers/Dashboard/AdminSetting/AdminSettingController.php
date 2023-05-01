<?php

namespace App\Http\Controllers\Dashboard\AdminSetting;

use App\App\Model\CommissionRegister;
use App\App\Model\IdCart;
use App\App\Models\PackagePin;
use App\DoctorRenewPincode;
use App\Http\Controllers\Controller;
use App\Model\Designation;
use App\Model\DesignationHistory;
use App\Model\DesignationSalaryAchievement;
use App\Model\DesignationSetting;
use App\Model\DesignationUsercount;
use App\Model\DoctorMemberPin;
use Illuminate\Http\Request;
use \App\Model\Dashboard\AdminSetting\AdminSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AdminSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        return view('dashboard.admin-setting.index', ['admin_settings' => AdminSetting::all()]);
    }

    public function update(Request $request)
    {
        $request->validate([
            "settingName" => ["required"]
        ]);
        $settingName = str_replace(" ", "_", $request->settingName);
        try {
            return $this->$settingName($request->settingValue);
        } catch (\BadMethodCallException $e) {
            return $e->getMessage();
        }
    }




    public function Monthly_Top_Seller_Bonus($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function Leader_AM_DisM_Div_BDM($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric($setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }



    public function Weekly_Top_Seller_Bonus($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function Daily_Top_Seller_Bonus($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }

        public function User_Package_Bonus($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function Designation_Setting($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function Daily_Free_Sign_Up_Bonus($settingValue){
        $setting_value_ok = true;
        if(!is_numeric( $settingValue )) {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function Daily_Action_Bonus_Shopping_Wallet($settingValue){
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0 && count($setting_value_array)< 3) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }

    public function User_Registration_Bonus($settingValue)
    {
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) > 0) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }
    public function User_Subscription_Bonus($settingValue)
    {
        $setting_value_array = explode(",",$settingValue);
        $setting_value_ok = true;
        if(count($setting_value_array) === 5) {
            foreach ($setting_value_array as $setting_value) {
                if(!is_numeric( $setting_value )) {
                    $setting_value_ok = false;
                    break;
                }
            }
        } else {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }
    public function User_Registration_Bonus_Time_Limit($settingValue)
    {
        $setting_value_array = json_decode($settingValue, true);
        $setting_value_ok = true;
        if(is_array($setting_value_array)) {
            if( !array_key_exists("M", $setting_value_array) || !is_numeric($setting_value_array["M"]) ) {
                $setting_value_ok = false;
            }
            if( !array_key_exists("H", $setting_value_array) || !is_numeric($setting_value_array["H"]) ) {
                $setting_value_ok = false;
            }
        } else {
            $setting_value_ok = false;
        }

        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }
    public function User_Registration_Bonus_Minimum_Order_Amount($settingValue)
    {
        $setting_value_ok = true;
        if(!is_numeric( $settingValue )) {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }

    public function User_Verification_Minimum_Order_Amount($settingValue)
    {
        $setting_value_ok = true;
        if(!is_numeric( $settingValue )) {
            $setting_value_ok = false;
        }
        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }

    public function First_Order_Cashback_Percentage ($settingValue)
    {
        $setting_value_ok = true;
        if(!is_numeric( $settingValue )) {
            $setting_value_ok = false;
        }
        if((double) $settingValue > 100) {
            $setting_value_ok = false;
        }


        $setting = AdminSetting::where('setting_name', '=', str_replace("_", " ", __FUNCTION__))->first();
        $setting->setting_value = $setting_value_ok ? $settingValue : null;
        $setting->save();
        return $setting;
    }


    public function pinGenerate(){
        $pincodes = PackagePin::where('type',  null)->get();
        return view('dashboard.admin-setting.pin_generate', compact('pincodes'));
    }


    public function addAinGenerate(Request $request){
        for($i = 0; $i < $request->number; $i++){
            $pin = new PackagePin();
            $pin->pincode = rand(11111111, 99999999);
            $pin->save();
        }
        return redirect()->back();
    }

    public function doctorMemberPinGenerate(){
        $pincodes = DoctorMemberPin::where('type', null)->get();
        return view('dashboard.admin-setting.doctor_member_pin_generate', compact('pincodes'));
    }


    public function doctorMemberPinCodeUsed(){
        $pincodes = DoctorMemberPin::where('type', 'use')->get();
        return view('dashboard.admin-setting.doctor_member_use_pin_generate', compact('pincodes'));
    }

    public function doctorMemberSellPinCode(Request $request){
        DoctorMemberPin::where('id', $request->id)->update(['sold' => $request->value]);
        return response()->json();
    }

    public function addDoctorMemberPinGenerate(Request $request){

        if($request->month == 1){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorMemberPin();
                $pin->pincode = rand(111, 999);
                $pin->month = $request->month;
                $pin->price = 100;
                $pin->save();
            }
        }elseif ($request->month == 3){

            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorMemberPin();
                $pin->pincode = rand(1111, 9999);
                $pin->month = $request->month;
                $pin->price = 250;
                $pin->save();
            }

        }elseif ($request->month == 6){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorMemberPin();
                $pin->pincode = rand(11111, 99999);
                $pin->month = $request->month;
                $pin->price = 500;
                $pin->save();
            }

        }elseif ($request->month == 12){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorMemberPin();
                $pin->pincode = rand(111111, 999999);
                $pin->month = $request->month;
                $pin->price = 1000;
                $pin->save();
            }
        }

        return redirect()->back();
    }



    public function getCommission(){
        $commission = CommissionRegister::all();
        return view('dashboard.admin-setting.commission_generate', compact('commission'));

    }


    public function postCommission(Request $request){
        CommissionRegister::where('id', $request->id)->update(['post_like'=> $request->post_like, 'post_comment'=> $request->post_comment, 'post_share' => $request->post_share, 'incentive_reward'=> $request->incentive_reward, 'instant_bonus' => $request->instant_bonus, 'daily_top_seller_bonus'=> $request->daily_top_seller_bonus, 'weakly_top_seller_bonus' => $request->weakly_top_seller_bonus, 'monthly_top_seller_bonus' => $request->monthly_top_seller_bonus, 'leader_bonus' => $request->leader_bonus, 'dealer_point_bonus' => $request->dealer_point_bonus, 'company_profit' => $request->company_profit, 'reserved_fund' => $request->reserved_fund, 'company_management' => $request->company_management]);
        return redirect()->back();
    }

    public function getUseGenerate(){
        $pincodes = PackagePin::where('type', 'use')->get();
        return view('dashboard.admin-setting.use_pin_generate', compact('pincodes'));
    }

    public function sellPinCode(Request $request){
        PackagePin::where('id', $request->id)->update(['sold' => $request->value]);
        return response()->json();
    }



    public function getIdCart(){
        $idCart = IdCart::where('status', 'pending')->get();
        return view('dashboard.admin-setting.id_cart', compact('idCart'));
    }

    public function getIdCartGiving(){
        $idCart = IdCart::where('status', 'complete')->get();
        return view('dashboard.admin-setting.id_cart_giving', compact('idCart'));
    }

    public function idCartActive(Request $request){
        IdCart::where('id', $request->id)->update(['status'=> 'complete']);
        return response()->json(['message'=> 'Update Successfully']);
    }

    public function idCartDelete(Request $request){
        IdCart::where('id', $request->id)->delete();
        return response()->json(['message'=> 'Deleted Successfully']);
    }

    public function monthDesclySalary(){
        $designation_fix_value = AdminSetting::where('setting_name','Designation Setting')->first();
        $designation_fix_value = explode(',', $designation_fix_value->setting_value);
        $designation = Designation::whereMonth('created_at', date('m'))->orderByDesc('id')->get();
        $user = DesignationUsercount::whereMonth('created_at', date('m'))->first();
        $total = DesignationSetting::whereMonth('created_at', date('m'))->first();
//        echo "<pre>"; print_r($user); die;
        $salary = DesignationSalaryAchievement::whereMonth('created_at', date('m'))->first();
        return view('dashboard.admin-setting.monthly_salary', compact('designation_fix_value', 'designation', 'user', 'salary', 'total'));
    }

    public function monthDesclySalaryHistory(){
       $salary =  DesignationHistory::select('package','MO', 'SMO', 'MEx', 'SMEx', 'RMM','MM', 'SMM', 'AGM', 'GM', 'created_at')
           ->orderBy('created_at', 'asc')->get();
        return view('dashboard.admin-setting.salary_history', compact( 'salary'));
    }


    public function doctorServiceRenewPincode(){
        $pincodes = DoctorRenewPincode::where('type', null)->get();
        return view('dashboard.admin-setting.doctor_servic_pincode_renew', compact('pincodes'));
    }


    public function doctorServiceRenewPincodeSubmit(Request $request){
        if($request->month == 1){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorRenewPincode();
                $pin->pincode = rand(111, 999);
                $pin->month = $request->month;
                $pin->save();
            }
        }elseif ($request->month == 3){

            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorRenewPincode();
                $pin->pincode = rand(1111, 9999);
                $pin->month = $request->month;
                $pin->save();
            }

        }elseif ($request->month == 6){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorRenewPincode();
                $pin->pincode = rand(11111, 99999);
                $pin->month = $request->month;
                $pin->save();
            }

        }elseif ($request->month == 12){
            for($i = 0; $i < $request->number; $i++){
                $pin = new DoctorRenewPincode();
                $pin->pincode = rand(111111, 999999);
                $pin->month = $request->month;
                $pin->save();
            }
        }

        return redirect()->back();
    }


    public function doctorServiceUsedRenewPincode(){
        $pincodes = DoctorRenewPincode::where('type', 'used')->get();
        return view('dashboard.admin-setting.doctor_servic_used_pincode_renew', compact('pincodes'));
    }

    public function doctorPincodeSell(Request $request){
        DoctorRenewPincode::where('id', $request->id)->update(['sold' => $request->value]);
        return response()->json();
    }










}
