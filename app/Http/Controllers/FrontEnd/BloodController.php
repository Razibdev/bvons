<?php

namespace App\Http\Controllers\FrontEnd;

use App\BloodStatus;
use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Village;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloodController extends Controller
{

    public function addStatus(Request $request){
        if($request->isMethod('post')){

            $request->validate([
                'blood_group' => 'required',
                'address' => 'required',
                'name' => 'required',
                'contact1' => 'required',
                'cause' => 'required',
                'blood_date' => 'required',
                'blood_time' => 'required',
                'blood_bag' => 'required',
                'patient' => 'required',
            ]);

            $data = $request->all();
            $blood = new BloodStatus();
            $blood->user_id = Auth::id();
            $blood->blood_group = $data['blood_group'];
            $blood->address = $data['address'];
            $blood->patient_name = $data['patient'];
            $blood->name1 = $data['name'];
            $blood->name2 = $data['name1'];
            $blood->name3 = $data['name3'];
            $blood->contact1 = $data['contact'];
            $blood->contact2 = $data['contact1'];
            $blood->contact3 = $data['contact3'];
            $blood->cause = $data['cause'];
            $blood->blood_date = $data['blood_date'];
            $blood->blood_time = $data['blood_time'];
            $blood->blood_bag = $data['blood_bag'];
            $blood->save();
            return redirect('/bvon/blood/user/view-status');
        }
        return view('blood.user.add_status');
    }


    public function viewStatus(){
        $bloods = BloodStatus::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('blood.user.view_status', compact('bloods'));
    }

    public function editStatus(Request $request, $id){

        if ($request->isMethod('post')){
            $request->validate([
                'blood_group' => 'required',
                'address' => 'required',
                'name' => 'required',
                'contact1' => 'required',
                'cause' => 'required',
                'blood_date' => 'required',
                'blood_time' => 'required',
                'blood_bag' => 'required',
                'patient' => 'required',
            ]);

            $data = $request->all();
            BloodStatus::where('id', $id)->update(['blood_group'=> $data['blood_group'], 'address'=> $data['address'], 'patient_name' => $data['patient'], 'name1'=> $data['name'], 'name2' => $data['name1'], 'name3' => $data['name3'], 'contact1' => $data['contact'], 'contact2' => $data['contact1'], 'contact3' => $data['contact3'], 'cause'=> $data['cause'], 'blood_date' => $data['blood_date'], 'blood_time' => $data['blood_time'], 'blood_bag' => $data['blood_bag']]);
            return redirect('/bvon/blood/user/view-status');
        }

        $status = BloodStatus::where('id', $id)->first();
        return view('blood.user.edit_status', compact('status'));
    }


    public function deleteStatus($id){
        BloodStatus::where('id', $id)->delete();
        return redirect()->back();
    }



    public function status(){
        $bloods = BloodStatus::orderByDesc('id')->get();
        return view('blood.blood.status', compact('bloods'));
    }

    public function statusGiving(Request $request){
        $district = District::all();
        $user = User::where('blood', '!=', null)->where('id', Auth::id())->first();
        $users = User::where('blood', '!=', null)->where('wishing', 1)->where('user_id', '!=', Auth::id())->join('eco_addresses', 'eco_addresses.user_id', 'users.id')->groupBy('eco_addresses.user_id')

            ->where( function($query) use($request){
                return $request->blood_group ?
                    $query->from('users')->where('blood',$request->blood_group) : '';
            })->orWhere(function($query) use($request){
                $dis = null;
                if(isset($request->district)){
                    $diss = explode('-', $request->district);
                    $dis = $diss[1];

                }
                return $request->district ?
                    $query->from('users')->where('city',$dis) : '';
            })->orWhere(function($query) use($request){

                if(isset($request->district)){
                    $dists = explode('-', $request->thana);
                    $dist = $dists[1];

                }
                return $request->thana ?
                    $query->from('users')->where('ps',$dist) : '';
            })
            ->get();



        return view('blood.blood.status_giving', compact('district', 'users', 'user'));
    }

    public function statusNeed(Request $request){
        $district = District::all();
        $users = User::where('blood', '!=', null)->join('eco_addresses', 'eco_addresses.user_id', 'users.id')->groupBy('eco_addresses.user_id')

            ->where( function($query) use($request){
            return $request->blood_group ?
                $query->from('users')->where('blood',$request->blood_group) : '';
        })->orWhere(function($query) use($request){
            $dis = null;
            if(isset($request->district)){
                $diss = explode('-', $request->district);
                $dis = $diss[1];

            }
            return $request->district ?
                $query->from('users')->where('city',$dis) : '';
        })->orWhere(function($query) use($request){

                if(isset($request->district)){
                    $dists = explode('-', $request->thana);
                    $dist = $dists[1];

                }
            return $request->thana ?
                $query->from('users')->where('ps',$dist) : '';
        })
            ->get();


        return view('blood.blood.status_need', compact('district', 'users'));
    }

    public function statusAlready(Request $request){
        $district = District::all();
        $user = User::where('blood', '!=', null)->where('id', Auth::id())->first();
        $users = User::where('blood', '!=', null)->where('wishing', 1)->where('user_id', '!=', Auth::id())->join('eco_addresses', 'eco_addresses.user_id', 'users.id')->groupBy('eco_addresses.user_id')

            ->where( function($query) use($request){
                return $request->blood_group ?
                    $query->from('users')->where('blood',$request->blood_group) : '';
            })->orWhere(function($query) use($request){
                $dis = null;
                if(isset($request->district)){
                    $diss = explode('-', $request->district);
                    $dis = $diss[1];

                }
                return $request->district ?
                    $query->from('users')->where('city',$dis) : '';
            })->orWhere(function($query) use($request){

                if(isset($request->district)){
                    $dists = explode('-', $request->thana);
                    $dist = $dists[1];

                }
                return $request->thana ?
                    $query->from('users')->where('ps',$dist) : '';
            })
            ->get();
        return view('blood.blood.status_already', compact('district', 'user', 'users'));
    }


    public function dependancyThana(Request $request){
        $explode = explode('-', $request->value);
        $data = Thana::where('district_id', $explode[0])->get();
        $output = '';
        foreach ($data as $row) {
            $output .= '<option value="'.$row->id.'-'.$row->name.'">'.$row->name.'</option>';
        }
        echo $output;
    }

    public function statusGivingUpdate(Request $request){
        User::where('id', Auth::id())->update(['wishing'=> $request->value]);
        return response()->json();
    }

    public function statusAlreadyUpdate(Request $request){
        User::where('id', Auth::id())->update(['donote_date' => $request->donation_date, 'next_date' => date("Y-m-d", strtotime($request->donation_date .' +4 months')), 'donote_number' => $request->number_of_d]);
        return response()->json();
    }














}
