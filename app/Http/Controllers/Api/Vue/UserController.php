<?php
namespace App\Http\Controllers\Api\Vue;
use App\App\Model\IdCart;
use App\App\Models\PackagePin;
use App\Http\Controllers\Controller;
use App\Model\ChangePassword;
use App\Model\DistrictOfficer;
use App\Model\FieldOfficer;
use App\Model\UpazillaOfficer;
use App\RelationMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function codeGenerate(Request $request){
        if($request->account == '' || $request->account == NULL){
            $account = NULL;
        }else{
           $account = $request->account;
        }


        $checkU = User::where(['referral_id'=> $account, 'phone' => $request->phone])->first();
        $checkUc = User::where(['referral_id'=> $account, 'phone' => $request->phone])->count();

        if($checkUc > 0){
            \Log::info($checkU);
            $checkUser = ChangePassword::where('user_id', $checkU->id)->count();
            if($checkUser > 0){
                ChangePassword::where('user_id', $checkU->id)->update(['code' => $request->code, 'phone' => $request->phone, 'referral_id' => $account]);
            }else{
                $changeCode = new ChangePassword();
                $changeCode->user_id = $checkU->id;
                $changeCode->code = $request->code;
                $changeCode->phone = $request->phone;
                $changeCode->referral_id = $account;
                $changeCode->save();

            }

            return response()->json(['message' =>'Successfully Sms Send Your Phone! Please Check Phone', 'type' => 'success']);
        }else{
            return response()->json(['message' =>'Phone or Account Number is invalid', 'type' => 'error']);

        }

    }


    public function codeCheck($phone){
        $code = ChangePassword::where('phone', $phone)->first();
        return $code->code;
    }

    public function changePassword(Request $request){
        if($request->account == '' || $request->account == NULL){
            $account = NULL;
        }else{
            $account = $request->account;
        }


        $checkU = User::where(['referral_id'=> $account, 'phone' => $request->phone])->first();
        $checkUc = User::where(['referral_id'=> $account, 'phone' => $request->phone])->count();
        if($checkUc>0){
            User::where(['referral_id'=> $account, 'phone' => $request->phone])->update(['password'=> bcrypt($request->password)]);
            ChangePassword::where('user_id', $checkU->id)->delete();
            return response()->json(['message' =>'Successfully change your password', 'type' => 'success']);
        }else{
            return response()->json(['message' =>'Something Wrong! try again!', 'type' => 'error']);
        }
    }

    public function codeSendForRegister(Request $request){
        \Log::info( $request->pincode);


        if ($request->pincode === 'null'){
            $userGen = User::where(['phone'=> $request->phone])->count();
            if($userGen > 0){
                return response()->json(['message' =>'Your are already member of bvon limited', 'type' => 'error']);
            }else{
                $checkUser = ChangePassword::where('phone', $request->phone)->count();
                if($checkUser > 0){
                    ChangePassword::where('phone', $request->phone)->update(['code' => $request->code]);
                }else{
                    $changeCode = new ChangePassword();
                    $changeCode->code = $request->code;
                    $changeCode->phone = $request->phone;
                    $changeCode->save();

                }
                return response()->json(['message' =>'Successfully Sms Send Your Phone! Please Check Phone', 'type' => 'success']);
            }


        }else{
            $userCheck = User::where('referral_id', $request->introduce)->count();
            if($userCheck> 0){
                $checkPin = PackagePin::where(['pincode'=> $request->pincode, 'type' => NULL])->count();
                if($checkPin > 0){
                    $checkUser = ChangePassword::where('phone', $request->phone)->count();
                    if($checkUser > 0){
                        ChangePassword::where('phone', $request->phone)->update(['code' => $request->code]);
                    }else{
                        $changeCode = new ChangePassword();
                        $changeCode->code = $request->code;
                        $changeCode->phone = $request->phone;
                        $changeCode->save();

                    }
                    return response()->json(['message' =>'Successfully Sms Send Your Phone! Please Check Phone', 'type' => 'success']);
                }else{
                    return response()->json(['message' =>'Your PinCode is invalid! Please try again', 'type' => 'error']);
                }
            }else{
                return response()->json(['message' =>'Your referral person account number is invalid', 'type' => 'error']);
            }

        }

    }



    public function getAllDealerFetch(){
        return User::where('dealer_referral_id', '!=', '')->where('dealer_referral_id', '!=', NULL)->select('id', 'name', 'dealer_referral_id')->get();
    }

    public function changeDealerIfNeed(Request $request){
        User::where('id', Auth::id())->update(['dealer_referral_by'=> $request->user]);
        return response()->json(['message' =>'Dealer Change Successfully', 'type' => 'success']);
    }

    public function applyIdCard(Request $request){
        $countUser = IdCart::where('user_id', Auth::id())->count();
        if($countUser == 0){
            if ($request->hasFile('media')) {
                $image_tmp = $request->file('media');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'media/cart' . '/' . Auth::id() . '/';
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $large_image_path = "media/cart/".Auth::id()."/" . $filename;
                Image::make($image_tmp)->resize(300, 300)->save($large_image_path);
            } else {
                $filename = null;
            }

            $checkDistrictOfficer = DistrictOfficer::where('user_id', Auth::id())->count();
            $checkUpazillaOfficer = UpazillaOfficer::where('user_id', Auth::id())->count();
            $checkFieldOfficer = FieldOfficer::where('user_id', Auth::id())->count();

            if ($checkDistrictOfficer == 1){
                $type = 'District Officer';
            }elseif($checkUpazillaOfficer == 1){
                $type = 'Upazilla Officer';
            }elseif($checkFieldOfficer == 1){
                $type = 'Field Officer';
            }else{
                $type = null;
            }


            $idcart = new IdCart();
            $idcart->user_id = Auth::id();
            $idcart->phone = $request->phone;
            $idcart->email = $request->email;
            $idcart->blood = $request->blood;
            $idcart->image = $filename;
            $idcart->account = Auth::user()->referral_id;
            $idcart->status ='pending';
            $idcart->type = $type;
            $idcart->save();
            return response()->json(['message' =>'Apply Successfully Done', 'type' => 'success']);

        }else{
            return response()->json(['message' =>'You are applied already for id card', 'type' => 'error']);
        }
    }


}
