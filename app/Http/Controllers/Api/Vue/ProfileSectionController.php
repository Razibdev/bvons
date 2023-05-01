<?php

namespace App\Http\Controllers\Api\Vue;

use App\App\Models\PackagePin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSectionController extends Controller
{
    public function applyPremiumUser(Request $request){
        $codeCheck = PackagePin::where(['pincode'=> $request->pincode, 'type' => null])->count();
        $codeCheckreu = PackagePin::where(['pincode'=> $request->pincode, 'type' => 'use', 'account' => Auth::user()->referral_id])->count();
        $user =  User::where('id', $request->user_id)->first();
        if($codeCheck > 0){
            if($user->type == 'GU' && $user->verified == 0){

                $info = new User();
                $referral_id = $info->makeReferralIdF();

                if($request->account != ''){
                    $checkref = User::where('referral_id', $request->account)->count();
                    if ($checkref > 0){
                        $checkrefs = User::where('referral_id', $request->account)->first();
                        $referral_by = $checkrefs->referral_id;
                    }else{
                        $referral_by = NULL;
                    }
                }else{
                    $referral_by = NULL;
                }

                User::where('id', $request->user_id)->update(['verified' => 1, 'referral_id' => $referral_id, 'referred_by' => $referral_by, 'type' => 'BP']);
                PackagePin::where(['pincode'=> $request->pincode, 'type' => null])->update(['type' => 'use', 'name' => $user->name, 'account' => $user->referral_id]);
                return response()->json(['message'=> 'Now you are premium user!!!', 'type' => 'success']);

            }

            else{

                return response()->json(['message'=> 'You are already premium user!!', 'type' => 'error']);
            }

        }else if($codeCheckreu ==1 ){
        if ($user->type != 'GU' && $user->verified == 1 && $user->referred_by == NULL){
                if($request->account != ''){
                    $checkref = User::where('referral_id', $request->account)->count();
                    if ($checkref > 0){
                        $checkrefs = User::where('referral_id', $request->account)->first();
                        $referral_by = $checkrefs->referral_id;
                    }else{
                        $referral_by = NULL;
                    }
                }else{
                    $referral_by = NULL;
                }
                User::where('id', $request->user_id)->update(['referred_by' => $referral_by]);
                return response()->json(['message'=> 'You referral person successfully changed', 'type' => 'success']);
            }else{
            return response()->json(['message'=> 'If you want to change referral! Please contact admin', 'type' => 'success']);
            }
        }

        else{
            return response()->json(['message'=> 'PinCode is Invalid', 'type' => 'error']);
        }
    }


    public function applyUsernameChange(Request $request){
        $user =  User::where('username', $request->username)->count();
        if($user === 0){
            User::where('id', Auth::id())->update(['username' => $request->username]);
            return response()->json(['message'=> 'Username change successfully done !', 'type' => 'success']);
        }else{
            return response()->json(['message'=> 'User Already Taken !! Try another Username', 'type' => 'error']);
        }

    }













}
