<?php

namespace App\Http\Controllers\Dashboard\BDoctor;

use App\BvonDoctorChamber;
use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\BDoctor;
use App\Model\BvonDoctorRegisterHistory;
use App\Model\BvonDoctorService;
use App\Model\DistrictOfficer;
use App\Model\DoctorMember;
use App\Model\DPrescription;
use App\Model\FieldOfficer;
use App\Model\UpazillaOfficer;
use App\RelationMember;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    public function index(){

        $doctors = BDoctor::all();
        return view('dashboard.bdoctor.index', compact('doctors'));
    }



    public function addDoctor(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'name' => 'required',
                'referred_id' => 'required',
                'gender' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'specialist' => 'required',
            ]);

            if($request->hasFile('profile_pic')){
                $image_tmp = $request->file('profile_pic');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $large_image_path = "media/doctor/service/image/".$filename;

                Image::make($image_tmp)->resize(150, 150)->save($large_image_path);
            }else{
                $filename = '';
            }

            if($data['details'] == ''){
                $data['details'] = '';
            }

            $userinfo = explode("-", $data['referred_id']);
            $doctor = new BDoctor();
            $doctor->referral_id = $userinfo[1];
            $doctor->user_id = $userinfo[0];
            $doctor->name = $data['name'];
            $doctor->age = $data['age'];
            $doctor->gender = $data['gender'];
            $doctor->email = $data['email'];
            $doctor->specialist = $data['specialist'];
            $doctor->phone = $data['phone'];
            $doctor->profile_pic = $filename;
            $doctor->details = $data['details'];
            $doctor->address = $data['address'];
            $doctor->save();

            User::where('id', $userinfo[0])->update(['type' => 'DC']);
            Toastr::success('Doctor add Successfully', 'success');
            return redirect('/dashboard/bvon-doctor/view-doctor');
        }

        $users = User::where('type', '!=', 'GU')->get();
        return view('dashboard.bdoctor.add_doctor', compact('users'));
    }



   public function editDoctor(Request $request, $id){
       $doctor = BDoctor::where('id', $id)->first();

       if($request->isMethod('post')){
           $data = $request->all();
           $request->validate([
               'name' => 'required',
               'referred_id' => 'required',
               'gender' => 'required',
               'phone' => 'required',
               'email' => 'required',
               'specialist' => 'required',
           ]);

           if($request->hasFile('profile_pic')){
               $image_tmp = $request->file('profile_pic');
               if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = rand(111111, 999999).'.'.$extension;

               }
               if (isset($doctor->profile_pic)){
                   $large_image_path = "media/doctor/service/image/".$doctor->profile_pic;

                   if(File::exists($large_image_path)){
                       File::delete($large_image_path);
                   }
               }

               $large_image_path = "media/doctor/service/image/".$filename;

               // Resize Image
               Image::make($image_tmp)->resize(150, 150)->save($large_image_path);

           }else{
               $filename = $request->current_image;
           }
           $userinfo = explode("-", $data['referred_id']);
           BDoctor::where('id', $id)->update(['name' => $data['name'], 'referral_id' => $userinfo[1], 'user_id' => $userinfo[0], 'address' => $data['address'], 'email' => $data['email'], 'specialist' => $data['specialist'], 'phone' => $data['phone'], 'gender' => $data['gender'], 'profile_pic' => $filename]);

    return redirect('/dashboard/bvon-doctor/view-doctor');

       }
       $users = User::where('type', '!=', 'GU')->get();
       return view('dashboard.bdoctor.edit_doctor', compact('users', 'doctor'));
   }


public function deleteDoctorInfo(Request $request){
    $doctor =BDoctor::where('id', $request->id)->first();
    if (isset($doctor->profile_pic)){
        $large_image_path = "media/doctor/image/".$doctor->profile_pic;

        if(File::exists($large_image_path)){
            File::delete($large_image_path);
        }
    }

    $doctor->delete();
    return response()->json();
}

public function doctorRegisterUserList(){
        $members = DoctorMember::orderByDesc('id')->get();
        return view('dashboard.bdoctor.register_user_list', compact('members'));
}


public function doctorRegisterUserSubMemberList($id){
        $members = RelationMember::where('member_id', $id)->get();
        return view('dashboard.bdoctor.register_user_list_sub_member', compact('members'));
}

public function deleteDoctorMember(Request $request){
    $doctorMember = DoctorMember::where('id', $request->id)->first();
    $doctorMember->delete();
    return response()->json();
}

public function patientPrescriptionList(){
        $prescriptions = DPrescription::with('doctor', 'user')->orderByDesc('id')->get();
//        return 'ok';
    return view('dashboard.bdoctor.patient_prescription_list', compact('prescriptions'));
}


public function bvonDoctorChamber(Request $request){

        if($request->isMethod('post')){
            $request->validate([
                'chamber_name' => 'required',
                'district' => 'required',
            ]);

            $chamber = new BvonDoctorChamber();
            $chamber->district_id = $request->district;
            $chamber->thana_id = $request->thana;
            $chamber->chamber_name = $request->chamber_name;
            $chamber->save();
            return redirect()->back();
        }
        $district = District::all();
        return view('dashboard.bdoctor.bvon_doctor_chamber_create', compact('district'));
}

public function bvonDoctorChamberList(){
        $chambers = BvonDoctorChamber::with('district', 'thana')->get();
//        $chambers = json_decode(json_encode($chambers));
//        echo "<pre>"; print_r($chambers);die;
        return view('dashboard.bdoctor.bvon_doctor_chamber_list', compact('chambers'));
}


public function bvonDoctorChamberEdit(Request $request, $id){
        $doctorChamber = BvonDoctorChamber::where('id', $id)->first();
        if($request->isMethod('post')){
            $request->validate([
                'chamber_name' => 'required',
                'district' => 'required',
            ]);

            BvonDoctorChamber::where('id', $id)->update(['district_id' => $request->district, 'thana_id' => $request->thana, 'chamber_name' => $request->chamber_name]);
            return redirect('dashboard/bvon-doctor/bvon-doctor-chamber-list');
        }
    $district = District::all();
        return view('dashboard.bdoctor.bvon_doctor_chamber_edit',compact('doctorChamber', 'district'));


}





public function deleteDoctorChamber(Request $request){
        BvonDoctorChamber::where('id', $request->id)->delete();
        return response()->json();
}
public function thanaDataDepndancy(Request $request){

    $data = Thana::where('district_id', $request->value)->get();
    $output = '<option value="">Select Thana</option>';
    foreach($data as $row)
    {
        $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
    }
    echo $output;
}


public function bvonDoctorServiceList (){
        $services = BvonDoctorService::orderByDesc('id')->with('district', 'thana')->get();
//        $services = json_decode( json_encode($services));
//        echo "<pre>"; print_r($services); die;
        return view('dashboard.bdoctor.bvon_service_list', compact('services'));
}

public function bvonDoctorAddServiceList(Request $request){
        if($request->isMethod('post')){
            if ($request->hasFile('logo')) {
                $image_tmp = $request->file('logo');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }

                $large_image_path = "media/doctor/service/" . $filename;

                Image::make($image_tmp)->resize(85, 85)->save($large_image_path);
            }else{
                $filename = null;
            }
            $services = new BvonDoctorService();
            $services->district_id = $request->district;
            $services->thana_id = $request->thana;
            $services->service = $request->service;
            $services->organization_name = $request->organization_name;
            $services->discount = $request->discount;
            $services->address = $request->address;
            $services->phone = $request->phone;
            $services->logo = $filename;
            $services->save();
            return redirect('dashboard/bvon-doctor/bvon-doctor-service-list');
        }

        $district = District::all();
        $thana = Thana::all();
        return view('dashboard.bdoctor.add_bvon_service_list', compact('district', 'thana'));
}


public function bvonDoctorServiceListEdit(Request $request, $id){
        $service = BvonDoctorService::where('id', $id)->first();
        $district = District::get();
        $thana = Thana::get();

        if($request->isMethod('post')){
            if ($request->hasFile('logo')) {
                $image_tmp = $request->file('logo');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }


                if (isset($doctor->profile_pic)){
                    $large_image_path = "media/doctor/service/".$service->logo;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }


                $large_image_path = "media/doctor/service/" . $filename;

                Image::make($image_tmp)->resize(85, 85)->save($large_image_path);
            }else{
                $filename = $request->current_logo;
            }




            BvonDoctorService::where('id', $id)->update([ 'organization_name'=> $request->organization_name, 'service'=> $request->service, 'district_id'=> $request->district, 'thana_id'=> $request->thana, 'discount' => $request->discount, 'address'=> $request->address, 'phone'=> $request->phone, 'logo' => $filename]);
            return redirect('/dashboard/bvon-doctor/bvon-doctor-service-list');

        }
        return view('dashboard.bdoctor.bvon_service_list_edit', compact('service', 'district', 'thana'));
}
















public function bvonDoctorServiceListDelete(Request $request){
    BvonDoctorService::where('id', $request->id)->delete();
    return response()->json();
}

public function bvonDoctorOfficerWorkList(){
      $fieldOfficer =  DoctorMember::groupBy('referral_id')->with('officer')->get();
//      $fieldOfficer = json_decode(json_encode($fieldOfficer));
//      echo "<pre>"; print_r($fieldOfficer);die;
      return view('dashboard.bdoctor.field_officer_work_list', compact('fieldOfficer'));
}

public function bvonDoctorOfficerWorkHistory($id){
    $fieldOfficer =  DoctorMember::where('referral_id', $id)->with('district', 'thana')->get();
//      $fieldOfficer = json_decode(json_encode($fieldOfficer));
//      echo "<pre>"; print_r($fieldOfficer);die;
    return view('dashboard.bdoctor.field_officer_work_history', compact('fieldOfficer'));
}

public function bvonDoctorOfficerIDCard(Request $request){
        User::where('id', $request->id)->update(['id_card' => $request->value]);
        return response()->json(['message' => 'Successfully Done Id Card give']);
}




public function bvonDoctorOfficerAdd(Request $request){

        if($request->isMethod('post')){
            $request->validate([
                'district' => 'required',
            ]);

            $data = $request->all();

            if(empty($data['upazilla'])){
                $data['upazilla'] = NULL;
            }

            if(empty($data['field'])){
                $data['field'] = NULL;
            }

            $districtOff = explode("-", $data['district']);
            $upazillaOff = explode("-", $data['upazilla']);
            $fieldOff = explode("-", $data['field']);

            if(!empty($data['district']) && empty( $data['upazilla']) && empty( $data['field'])){
                $cheDistrict = DistrictOfficer::where('user_id', $districtOff[0])->count();
                if($cheDistrict == 0){
                    $district = new DistrictOfficer();
                    $district->user_id = $districtOff[0];
                    $district->account = $districtOff[1];
                    $district->type = 'district';
                    $district->save();
                    Toastr::success('One more add in  District Officer Successfully', 'Success');
                    return redirect()->back();

                }else{
                    Toastr::error('This person already added in District Officer', 'Error');
                    return redirect()->back();
                }

            }else if(!empty($data['district']) && !empty( $data['upazilla']) && empty( $data['field'])){
                    $cheUpazilla = UpazillaOfficer::where('user_id', $upazillaOff[0])->count();
                    $checkDistrict = DistrictOfficer::where('user_id', $districtOff[0])->first();
                    $checkDistrictcs = DistrictOfficer::where('user_id', $districtOff[0])->count();
                    if ($checkDistrictcs > 0){
                        if($cheUpazilla == 0){
                            $upazilla = new UpazillaOfficer();
                            $upazilla->district_officer_id = $checkDistrict->id;
                            $upazilla->user_id = $upazillaOff[0];
                            $upazilla->account = $upazillaOff[1];
                            $upazilla->type = 'upazilla';
                            $upazilla->save();
                            Toastr::success('One more add in  Upazilla Officer Successfully', 'Success');
                            return redirect()->back();

                        }else{
                            Toastr::error('This person already added in Upazilla Officer', 'Error');
                            return redirect()->back();
                        }
                    }else{
                        Toastr::error('District Or Upazilla Officer Invalid', 'Error');
                    }



            }else if(!empty($data['district']) && !empty($data['upazilla']) && !empty( $data['field'])){
                $checkDistrict  = DistrictOfficer::where('user_id', $districtOff[0])->first();
                $checkDistrictc = DistrictOfficer::where('user_id', $districtOff[0])->count();
//                \Log::info($checkDistrictc);
                $checkUpazilla  = UpazillaOfficer::where('user_id', $upazillaOff[0])->first();
                $checkUpazillac = UpazillaOfficer::where('user_id', $upazillaOff[0])->count();
//                \Log::info($checkUpazillac);

                if($checkDistrictc > 0 && $checkUpazillac > 0){
                    $field = new FieldOfficer();
                    $field->district_officer_id = $checkDistrict->id;
                    $field->upazilla_officer_id = $checkUpazilla->id;
                    $field->user_id = $fieldOff[0];
                    $field->account = $fieldOff[1];
                    $field->type = 'field';
                    $field->save();
                    Toastr::success('One more add in  Field Officer Successfully', 'Success');
                    return redirect()->back();
                }else{
                    Toastr::error('District Or Upazilla Officer Invalid', 'Error');
                }



            }else{
                Toastr::error('Please follow the Chain Process', 'Error');
            }

            return redirect()->back();

        }

        $users = User::where('type', '!=', 'GU')->select('id', 'name', 'referral_id','phone')->with('upaofficer', 'fieldofficer')->get();
        $usersu = User::where('type', '!=', 'GU')->select('id', 'name', 'referral_id','phone')->with('disofficer', 'fieldofficer')->get();
        $usersf = User::where('type', '!=', 'GU')->select('id', 'name', 'referral_id','phone')->with('disofficer', 'upaofficer', 'fieldofficer')->get();
        return view('dashboard.doctor_officer.add_doctor_officer', compact('users', 'usersu', 'usersf'));
}


public function bvonDoctorOfficerView(){
    $users = DistrictOfficer::with('user')->get();
    return view('dashboard.doctor_officer.view_doctor_officer', compact('users'));
}



    public function fetch(Request $request){

        $data = UpazillaOfficer::where('district_officer_id', $request->value)->get();
        $output = '<option value="">Select Upazilla</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->user->name.' '.$row->user->referral_id.'</option>';
        }
        echo $output;
    }


    public function fetchTable(Request $request){

        $data = UpazillaOfficer::where('district_officer_id', $request->value)->get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentSalary = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentSalary / 300000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentSalary / 300000)*15000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }

            $underFieldOfficer = FieldOfficer::where('upazilla_officer_id', $row->id)->count();

            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>'.$underFieldOfficer.'</td>';
            $output .= '<td>300</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a></td>';

            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a> <br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">view Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }


    public function fetchTableField(Request $request){
        $data = FieldOfficer::where('upazilla_officer_id', $request->value)->get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentSalary = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentSalary / 30000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentSalary / 30000)*10000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }


            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>0</td>';
            $output .= '<td>30</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a></td>';
            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a><br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">View Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }




      public function fetchTableDistrict(){
        $data = DistrictOfficer::get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentSalary = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentSalary / 1500000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentSalary / 1500000)*20000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }



            $underUpazillaOfficer = UpazillaOfficer::where('district_officer_id', $row->id)->count();
            $underFieldOfficer = FieldOfficer::where('district_officer_id', $row->id)->count();
            $underTotal = $underUpazillaOfficer+ $underFieldOfficer;
            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>'.$underTotal.'</td>';
            $output .= '<td>1500</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a></td>';

            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a> <br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">View Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }



    public function bvonDoctorOfficerViewDetails($id, $type){
        $bvonRegisterHistory = array();
        if($type == 'district'){
            $districtOff = DistrictOfficer::where('id', $id)->first();
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('district_officer_id', $id)->with('district');
        }else if($type = 'upazilla'){
            $upazillaOff = UpazillaOfficer::where('id', $id)->first();
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('upazilla_officer_id', $id)->with('upazilla');

        }else if($type == 'field'){
            $fieldOff = FieldOfficer::where('id', $id)->first();
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('field_officer_id', $id)->with('field');

        }

        $bvonRegisterHistory = $bvonRegisterHistory->orderByDesc('id')->get();
//        foreach ($bvonRegisterHistory as $bvon){
////            $bvonRegisterHistory = json_decode(json_encode($bvonRegisterHistory));
//            echo "<pre>"; print_r($bvon->district->user->name); die;
//        }

        return view('dashboard.doctor_officer.view_doctor_officer_details', compact('bvonRegisterHistory'));

    }


    public function bvonDoctorOfficerWorkHistoryAll($id, $type){
        $bvonRegisterHistory = array();
        if($type == 'district'){
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('district_officer_id', $id)->with('district');

        }else if($type == 'upazilla'){
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('upazilla_officer_id', $id)->with('upazilla');


        }else if($type == 'field'){
            $bvonRegisterHistory = BvonDoctorRegisterHistory::where('field_officer_id', $id)->with('field');

        }

        $bvonRegisterHistory = $bvonRegisterHistory->select('*',
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name")
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->orderByDesc('id')
            ->get();



//        $bvonRegisterHistory = json_decode( json_encode($bvonRegisterHistory));
//
//       echo "<pre>"; print_r($bvonRegisterHistory);die;

            return view('dashboard.doctor_officer.view_doctor_officer_work_history', compact('bvonRegisterHistory', 'type'));
    }



    public function bvonDoctorOfficerSignUpHistoryAll($id, $type){
//        $bvonRegisterHistory = array();
        if($type == 'district'){
            $bvonRegisterHistorys = DistrictOfficer::where('id', $id)->first();

        }else if($type == 'upazilla'){
            $bvonRegisterHistorys = UpazillaOfficer::where('id', $id)->first();


        }else if($type == 'field'){
            $bvonRegisterHistorys = FieldOfficer::where('id', $id)->first();

        }



     $bvonRegister =  $bvonRegisterHistorys['account'];

        $bvonRegisterHistory = User::where('referred_by', $bvonRegister)
            ->orderByDesc('id')
            ->get();



        $bvonRegisterCount = User::where('referred_by', $bvonRegister)->select('created_at',
            DB::raw("(COUNT(*)) as count")
        )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderByDesc('id')
            ->get();

//        return $bvonRegisterCount;

//        return $bvonRegisterHistory->account;

        return view('dashboard.doctor_officer.view_doctor_officer_signup_history', compact('bvonRegisterHistory', 'type', 'bvonRegisterCount'));

    }



    public function getDistrictDoctorOfficer(){

       return view('dashboard.doctor_officer.get_district_doctor_officer');
    }

    public function getDistrictDoctorOfficerFetch(){
        $data = DistrictOfficer::get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentSalary = BvonDoctorRegisterHistory::where('district_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentSalary / 1500000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentSalary / 1500000)*20000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }



            $underUpazillaOfficer = UpazillaOfficer::where('district_officer_id', $row->id)->count();
            $underFieldOfficer = FieldOfficer::where('district_officer_id', $row->id)->count();
            $underTotal = $underUpazillaOfficer+ $underFieldOfficer;
            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>'.$underTotal.'</td>';
            $output .= '<td>1500</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a> <br>  <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-list-under-district/'.$row->id.'/'.$row->type).'">Downline</a></td>';

            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a> <br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">View Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }


    public function getUpazillaDoctorOfficer(){
        return view('dashboard.doctor_officer.get_upazilla_doctor_officer');
    }


    public function getUpazillaDoctorOfficerFetch(){
        $data = UpazillaOfficer::get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentSalary = BvonDoctorRegisterHistory::where('upazilla_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentSalary / 300000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentSalary / 300000)*15000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }


            $underFieldOfficer = FieldOfficer::where('upazilla_officer_id', $row->id)->count();
            $underTotal =  $underFieldOfficer;
            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>'.$underTotal.'</td>';
            $output .= '<td>300</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a> <br> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-list-under-upazilla/'.$row->id.'/'.$row->type).'">Downline</a></td>';

            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a> <br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">View Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }



    public function getFieldDoctorOfficer(){
        return view('dashboard.doctor_officer.get_field_doctor_officer');
    }

    public function getFieldDoctorOfficerFetch(){
        $data = FieldOfficer::get();
        $output = '';
        foreach($data as $row)
        {
            $totalRegister = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->count();
            $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->count();
            $totalRegistercurrentMonthAmount = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
            $percentage= 0;
            if($totalRegistercurrentMonth > 0){
                $percentage = ($totalRegistercurrentMonthAmount / 30000)*100;
                $percentage =  number_format((float)$percentage, 2, '.', ',');
            }
            $salary = 0;
            if($totalRegistercurrentMonth > 0){
                $test = ($totalRegistercurrentMonthAmount / 30000)*15000;
                $salary =  number_format((float)$test, 2, '.', ', ');
            }


            $output .= '<tr>';
            $output .= '<td>'.$row->id.'</td>';
            $output .= '<td><img style="width: 100px; height: 100px;" src="'.asset('media/user/profile_pic/'.$row->user->id.'/'.$row->user->profile_pic).'" alt=""></td>';
            $output .= '<td>'.$row->user->name.'</td>';
            $output .= '<td>'.$row->user->referral_id.'</td>';
            $output .= '<td>'.$row->user->phone.'</td>';
            $output .= '<td>'.$totalRegister.'</td>';
            $output .= '<td>'.$totalRegistercurrentMonth.'</td>';
            $output .= '<td>300</td>';
            $output .= '<td>'.$percentage.'%</td>';
            $output .= '<td width="10%">'.$salary.'</td>';
            $output .= '<td width="10%"><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$row->id.'/'.$row->type).'">Sign Up</a></td>';

            $output .= '<td> <a href="'.url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type).'">Work History</a> <br><a href="'.url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type).'">View Details</a></td>';
            $output .= '</tr>';
        }
        echo $output;
    }



    public function bvonDoctorOfficerDistrictList($id, $type)
    {
        $thanaofficers = UpazillaOfficer::where('district_officer_id', $id)->with('user')->get();
        $fieldOfficers = FieldOfficer::where('district_officer_id', $id)->with('user')->get();
        return view('dashboard.doctor_officer.district_officer_details', compact('thanaofficers', 'fieldOfficers'));
    }

    public function bvonDoctorOfficerUpazillaList($id, $type){
         $fieldOfficers = FieldOfficer::where('upazilla_officer_id', $id)->with('user')->get();

          return view('dashboard.doctor_officer.upazilla_officer_details', compact('fieldOfficers'));
    }
























}
