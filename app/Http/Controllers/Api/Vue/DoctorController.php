<?php

namespace App\Http\Controllers\Api\Vue;

use App\BvonDoctorChamber;
use App\DoctorRenewPincode;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\ThanaResource;
use App\Model\BDoctor;
use App\Model\BpayMarchantShop;
use App\Model\BvonDoctorRegisterHistory;
use App\Model\BvonDoctorService;
use App\Model\DistrictOfficer;
use App\Model\DoctorChamberToken;
use App\Model\DoctorMember;
use App\Model\DoctorMemberPin;
use App\Model\DPrescription;
use App\Model\FieldOfficer;
use App\Model\UpazillaOfficer;
use App\RelationMember;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    public function getDoctorUserListView(){
        $users = DoctorMember::get();
        return response()->json($users);
    }

    public function addPrescription(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'username' => 'required',
                'message' => 'required'
            ]);

            $doctor = BDoctor::where('user_id', Auth::id())->first();


            $prescription = new DPrescription();
            $prescription->user_id = $request->username;
            $prescription->message = $request->message;
            $prescription->doctor_id = $doctor->id;
            $prescription->sub_member = $request->selectMember;
            $prescription->save();
            $doctor_user = DoctorMember::where('id', $request->username)->first();
            return response()->json(['phone'=> $doctor_user->phone, 'message'=> 'Send Message Successfully Done']);

        }
    }

    public function getDoctorPrescriptionUserView($id){
        $doctor = BDoctor::where('user_id', $id)->first();
        $user = DPrescription::where('doctor_id', $doctor->id)->with('user', 'doctor')->get();
        return response()->json($user);
    }
    public function getAllMemberList(){
        $user = DoctorMember::with('members')->get();
        return response()->json($user);
    }

    public function bvonDoctorService(Request $request){

        if($request->isMethod('post')) {
            $data = $request->all();

//            $price = 0;
//            if($request->duration == 1){
//                $price = 100;
//                $newDateTime = Carbon::now()->addMonth();
//
//            }elseif ($request->duration == 3){
//                $price = 250;
//                $newDateTime = Carbon::now()->addMonths(3);
//
//            }elseif ($request->duration == 6){
//                $price = 500;
//                $newDateTime = Carbon::now()->addMonths(6);
//
//            }elseif ($request->duration == 12){
//                $price = 1000;
//                $newDateTime = Carbon::now()->addMonths(12);
//
//            }

//            \Log::info($newDateTime);

            $fieldOfficerCount = FieldOfficer::where('account', $request->account)->count();
            $upzillaOfficerCount = UpazillaOfficer::where('account', $request->account)->count();
            $districtOfficerCount = DistrictOfficer::where('account', $request->account)->count();
            $values = $fieldOfficerCount+$upzillaOfficerCount+$districtOfficerCount;

            if($values > 0) {

                $checkMember = DoctorMember::where('user_id', $request->user_id)->count();
                if ($checkMember === 0) {
//                \Log::debug($request->name);
                    $checkPin = DoctorMemberPin::where(['pincode' => $request->pin, 'type' => NULL]);
                    $usercheck = User::where('id', $request->user_id)->first();
                    $checkValue = DoctorMemberPin::where(['pincode' => $request->pin, 'type' => NULL])->first();

                    if ($checkPin->count()) {

                        if ($request->hasFile('media')) {
                            $image_tmp = $request->file('media');
                            if ($image_tmp->isValid()) {
                                $extension = $image_tmp->getClientOriginalExtension();
                                $filename = rand(111111, 999999) . '.' . $extension;

                            }

                            $large_image_path = "media/doctor/service/image/" . $filename;

                            Image::make($image_tmp)->resize(574, 264)->save($large_image_path);
                        } else {
                            $filename = null;
                        }


//                    return $filename;
                        $register = new DoctorMember();
                        $register->user_id = $request->user_id;
                        $register->referral_id = $request->account;
                        $register->name = $request->name;
                        $register->blood_group = $request->blood;
                        $register->profile_pic = $filename;
//            echo"<pre>"; print_r($request->form.account); die;
                        $register->age = $request->age;
//            $register->email = $request->form->email;
                        $register->phone = $request->phone;
                        $register->district_id = $request->selectDistrict;
                        $register->thana_id = $request->area;
                        $register->occupation = $request->occupation;
                        $register->member = $request->selectMemeber;
                        $register->village = $request->village;
                        $register->save();

                        $member_id = DB::getPdo()->lastInsertId();

                        for ($i = 1; $i <= $request->selectMemeber; $i++) {
//                \Log::info($request['form']['relation'][$i]);
                            $relation = explode(",", $request->relation);
                            $rname = explode(",", $request->rname);
                            $rage = explode(",", $request->rage);
                            $roccupation = explode(",", $request->roccupation);

                            $member = New RelationMember();
                            $member->member_id = $member_id;
                            $member->relation = $relation[$i];
                            $member->name = $rname[$i];
                            $member->age = $rage[$i];
                            $member->occupation = $roccupation[$i];
                            $member->save();

                        }


                        if ($fieldOfficerCount > 0) {
                            $fieldOfficerOff = FieldOfficer::where('account', $request->account)->first();
                            $registerOfficer = new BvonDoctorRegisterHistory();
                            $registerOfficer->district_officer_id = $fieldOfficerOff->district_officer_id;
                            $registerOfficer->upazilla_officer_id = $fieldOfficerOff->upazilla_officer_id;
                            $registerOfficer->field_officer_id = $fieldOfficerOff->id;
                            $registerOfficer->register_date = date('Y-m-d');
                            $registerOfficer->name = $request->name;
                            $registerOfficer->phone = $request->phone;
                            $registerOfficer->account = Auth::user()->referral_id;
                            $registerOfficer->user_id = Auth::id();
                            $registerOfficer->doctor_member_id = $member_id;
                            $registerOfficer->amount = $checkValue->price;
                            $registerOfficer->save();

                        } else if ($upzillaOfficerCount > 0) {
                            $upazillaOfficer = UpazillaOfficer::where('account', $request->account)->first();
                            $registerOfficer = new BvonDoctorRegisterHistory();
                            $registerOfficer->district_officer_id = $upazillaOfficer->district_officer_id;
                            $registerOfficer->upazilla_officer_id = $upazillaOfficer->id;
                            $registerOfficer->field_officer_id = NULL;
                            $registerOfficer->register_date = date('Y-m-d');
                            $registerOfficer->name = $request->name;
                            $registerOfficer->phone = $request->phone;
                            $registerOfficer->account = Auth::user()->referral_id;
                            $registerOfficer->user_id = Auth::id();
                            $registerOfficer->doctor_member_id = $member_id;
                            $registerOfficer->amount = $checkValue->price;
                            $registerOfficer->save();

                        } else if ($districtOfficerCount) {
                            $districtOfficer = DistrictOfficer::where('account', $request->account)->first();
                            $registerOfficer = new BvonDoctorRegisterHistory();
                            $registerOfficer->district_officer_id = $districtOfficer->id;
                            $registerOfficer->upazilla_officer_id = NULL;
                            $registerOfficer->field_officer_id = NULL;
                            $registerOfficer->register_date = date('Y-m-d');
                            $registerOfficer->name = $request->name;
                            $registerOfficer->phone = $request->phone;
                            $registerOfficer->account = Auth::user()->referral_id;
                            $registerOfficer->user_id = Auth::id();
                            $registerOfficer->doctor_member_id = $member_id;
                            $registerOfficer->amount = $checkValue->price;
                            $registerOfficer->save();

                        }

                        if($checkValue->month == 1){
                            User::where('id', $request->user_id)->update(['doctor_service' => 1, 'doctor_service_activation' => Carbon::now()->addMonth()]);

                        }else{
                            User::where('id', $request->user_id)->update(['doctor_service' => 1, 'doctor_service_activation' => Carbon::now()->addMonths($checkValue->month)]);

                        }

                        DoctorMemberPin::where(['pincode' => $request->pin])->update(['account' => $usercheck->referral_id, 'name' => $usercheck->name, 'type' => 'use']);
                        return response()->json(['message' => 'You are  memeber of Bvon Doctor!', 'type' => 'success']);
                    } else {
                        return response()->json(['message' => 'You PinCode is Invalid', 'type' => 'error']);
                    }

                } else {
                    return response()->json(['message' => 'You are already memeber of Bvon Doctor!', 'type' => 'error']);
                }


            }
            else{
                return response()->json(['message' => 'Your referral person are not bvon doctor service officer', 'type' => 'error']);
            }





        }
    }


    public function bvonDoctorPrescriptionSubMember(){
        $district = request('member_id');
        $member = RelationMember::where('member_id', $district)->get();
        return $member;
    }




    public function bvonDoctorServiceToken(){
        $district = request('district_id');
        $area = BvonDoctorChamber::where('district_id', $district)->get();
        return $area;
    }

    public function bvonDoctorServiceTokenThana(){
        $thana = request('thana_id');
        $area = BvonDoctorChamber::where('thana_id', $thana)->get();
        return $area;
    }

    public function bvonDoctorServiceAppointmentSubmit(Request $request){
        $month = Carbon::now()->month;
        $now = Carbon::now();
        $dateexplode = explode('-', $request->date);
        \Log::info( $request->date);
        $user = DoctorChamberToken::where('user_id', $request->user_id)->whereMonth('created_at', '=', $month)->first();
        $userC = DoctorChamberToken::where('user_id', $request->user_id)->whereMonth('created_at', '=', $month)->count();


        if($request->date == null ){
            $total_verified_today = DoctorChamberToken::whereDate('created_at', date('Y-m-d'))->count();
            $limit = 99 + 1;
            if($total_verified_today >= ($limit - 1)) {
                return response()->json(['message' => 'Today Appointment List full Try another day', 'type' => 'error']);
            }
            $serial = Str::substr((string)($limit + $total_verified_today + 1), 1);
            $sn =  $now->format('dmY') . "{$serial}";
        }else{
            $total_verified_today = DoctorChamberToken::whereDate('created_at', $request->date)->count();
            $limit = 99 + 1;
            if($total_verified_today >= ($limit - 1)) {
                return response()->json(['message' => 'Today Appointment List full Try another day', 'type' => 'success']);
            }
            $serial = Str::substr((string)($limit + $total_verified_today + 1), 1);
            $sn =  $dateexplode[2].$dateexplode[1].$dateexplode[0] . "{$serial}";
        }

        if($request->isMethod('post')){
            if($userC == 0){
                $token = new DoctorChamberToken();
                $token->user_id = $request->user_id;
                $token->district_id = $request->district;
                $token->thana_id = $request->area;
                $token->chamber_id = $request->chamber;
                if($request->date == null){
                    $token->appointment_date = date('Y-m-d');
                }else{
                    $token->appointment_date = $request->date;
                }
                $token->token = $sn;
                $token->save();
                return response()->json(['message' => 'Appointment Successfully Done !', 'type' => 'success']);
            }else{
                return response()->json(['message' => 'Your Appointment already done !', 'type' => 'error']);
            }

        }

    }


    public function bvonDoctorServiceTokens($id){
        $month = Carbon::now()->month;
        $count = DoctorChamberToken::where('user_id', $id)->whereMonth('created_at', '=', $month)->count();
        $token = '';
        if($count){
            $token = DoctorChamberToken::where('user_id', $id)->whereMonth('created_at', '=', $month)->first()->token;

        }
        return $token;
    }


    public function bvonDoctorServiceFetch(){
        return BvonDoctorService::get();
    }


    public function bvonDoctorServiceFetchFilter(Request $request){
        return BvonDoctorService::where('district_id', $request->district_id)->get();
    }

    public function bvonDoctorServiceFetchFilterThana(Request $request){
        return BvonDoctorService::where('thana_id', $request->thana_id)->get();
    }

    public function bvonDoctorServiceFetchFilterService(Request $request){
        return BvonDoctorService::where('service', $request->service)->get();
    }



    public function bvonDoctorPrescriptionList($id){
        $patients = DoctorMember::where('user_id', $id)->first();
        return DPrescription::where('user_id', $patients->id)->with('user', 'doctor', 'submember')->orderByDesc('id')->get();


    }

    //second page officer check now ok

    public function secondPageOfficerCheck(){

        $bvonDoctord = DistrictOfficer::where('user_id', Auth::id())->count();
        $bvonDoctoru = UpazillaOfficer::where('user_id', Auth::id())->count();
        $bvonDoctorf = FieldOfficer::where('user_id', Auth::id())->count();
        $value =$bvonDoctord + $bvonDoctoru+ $bvonDoctorf;
//        $value = 0;
        return response()->json(['data' => $value]);
    }


    //bvon doctor officer target list here

    public function doctorOfficerTargetList(){
        $targetList = array();

        $bvonDoctord = DistrictOfficer::where('user_id', Auth::id())->count();
        $bvonDoctoru = UpazillaOfficer::where('user_id', Auth::id())->count();
        $bvonDoctorf = FieldOfficer::where('user_id', Auth::id())->count();
        $allUsers = 0;
        if($bvonDoctord> 0){
            $district = DistrictOfficer::where('user_id', Auth::id())->first();
            $type = $district->type;


            $targetList = BvonDoctorRegisterHistory::where('district_officer_id', $district->id)->with('district');

            $upazila = UpazillaOfficer::where('district_officer_id', district->id)->count();
             $field = FieldOfficer::where('district_officer_id', district->id)->count();

             $allUsers = $upazila + $field;

        }
        else if($bvonDoctoru > 0){
            $upazila = UpazillaOfficer::where('user_id', Auth::id())->first();
            $type = $upazila->type;
            $targetList = BvonDoctorRegisterHistory::where('upazilla_officer_id', $upazila->id)->with('upazilla');

             $field = FieldOfficer::where('upazilla_officer_id', district->id)->count();
             $allUsers =  $field;
        }
        else if($bvonDoctorf > 0){
            $field = FieldOfficer::where('user_id', Auth::id())->first();
            $type = $field->type;

            $targetList = BvonDoctorRegisterHistory::where('field_officer_id', $field->id)->with('field');
            $allUsers = 0;
        }

        $targetList = $targetList->select('*',
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->orderByDesc('id')
            ->get();

        return response()->json(['data' => $targetList, 'type' => $type, 'all' => $allUsers]);
    }


    public function doctorOfficerSignUpList($id){
        $checkUser = User::where('id', $id)->first();
        return User::where('referred_by', $checkUser->referral_id)->orderByDesc('id')->get();
    }

    public function getDoctorActivation(){
        return User::where(['id' => Auth::id()])->where('doctor_service_activation', '>=', date('Y-m-d'))->count();
    }

    public function doctorServiceRenewSubmit(Request $request){
        $checkPinc = DoctorRenewPincode::where(['pincode' => $request->pincode, 'type' => null])->count();
        if($checkPinc > 0){
            $checkPin = DoctorRenewPincode::where(['pincode' => $request->pincode, 'type' => null])->first();
            if($checkPin->month == 1){
                User::where('id', Auth::id())->update(['doctor_service_activation' => Carbon::now()->addMonth()]);
            }else{
                User::where('id', Auth::id())->update(['doctor_service_activation' => Carbon::now()->addMonths($checkPin->month)]);
            }

            DoctorRenewPincode::where(['pincode' => $request->pincode, 'type' => null])->update(['type' => 'used', 'name' => Auth::user()->name, 'account' => Auth::user()->referral_id]);
            return response()->json(['message' => 'Your Doctor Service Subscription Successfully done !', 'type' => 'success']);
        }else{
            return response()->json(['message' => 'PinCode is Invalid', 'type' => 'error']);
        }



    }

    public function doctorListFetch(){
        return BDoctor::get();
    }
























}
