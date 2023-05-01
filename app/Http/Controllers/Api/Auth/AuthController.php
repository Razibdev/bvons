<?php
namespace App\Http\Controllers\Api\Auth;

use App\App\Model\ComisionBonus;
use App\App\Model\CommissionRegister;
use App\App\Models\PackagePin;
use App\Http\Controllers\Controller;
use App\Model\Bdealer\Bdealer;
use App\Model\Transaction\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

    use RegisterUser;

    public function __construct()
    {
//        $this->middleware(
//            'auth:api', [
//                'except' => ['login', 'register', 'userExists', 'validateReferralId', 'isAuth']
//            ]
//        );

        $this->middleware('JWT', [
            'except' =>['login', 'register', 'userExists', 'validateReferralId', 'isAuth', 'userInfo']
        ]);
    }

    protected function respondWithToken($token)
    {
        $dealer = Bdealer::where(['user_id'=> $this->guard()->user()->id, 'status' => 'active'])->count();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $this->guard()->user()->name,
            'phone' => $this->guard()->user()->phone,
            'address' => $this->guard()->user()->address,
            'email' => $this->guard()->user()->email,
            'blood' => $this->guard()->user()->blood,
            'user_type' => $this->guard()->user()->type,
            'dealer' => $dealer ? true : false
        ]);
    }


//    protected function respondWithToken($token){
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => Auth::factory()->getTTL() * 60,
//            'user' => auth()->user()->name
//        ]);
//    }

//    public function login(Request $request)
//    {
////        if(!$request->has('token')) return response()->json(['error' => 'invalid token'], 401);
////       print_r($request); die();
//
//        $credentials = $request->only( 'phone', 'password');
//
//        if ($token = $this->guard()->attempt($credentials)) {
//
//            $this->guard()->user()->update([
//                'fcm_token' => $request->token
//            ]);
//            return $this->respondWithToken($token);
//
//
//
//        }
//
//        return response()->json(['error' => 'Unauthorized'], 401);
//    }






    public function login(Request $request)
    {
        $data = $request->all();
        $userDetails = User::where('phone', $data['phone'])->count();

        $userusernameCount = User::where('username', $data['phone'])->count();
        $userusernameDetails = User::where('username', $data['phone'])->first();

        if($userusernameCount == 1){
            if(Hash::check($request->password, $userusernameDetails->password)){
                if($token = $this->guard()->attempt(['username' => $request->phone, 'password' => $request->password])){
                    $token = $this->respondWithToken($token);
                    $session_id = Cookie::get('session_id');
                    DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $this->guard()->user()->phone, 'user_type' =>  $this->guard()->user()->type]);
                    return response()->json(['token' =>$token, 'message'=> 'LogIn done Successfully!', 'type'=> 'success']);
                }else{
                    return response()->json(['message' => 'Login Error Please try again!', 'type'=> 'error']);
                }
            }else{
                return response()->json(['message' => 'Password number not match!', 'type'=> 'error']);
            }
        }elseif($userDetails == 1){
            $userDetailses = User::where('phone', $data['phone'])->first();
            if(Hash::check($request->password, $userDetailses->password)){
                if($token = $this->guard()->attempt(['phone' => $request->phone, 'password' => $request->password])){
                    $token = $this->respondWithToken($token);
                    $session_id = Cookie::get('session_id');
                    DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $this->guard()->user()->phone, 'user_type' =>  $this->guard()->user()->type]);
                    return response()->json(['token' =>$token, 'message'=> 'LogIn done Successfully!', 'type'=> 'success']);

                }else{
                    return response()->json(['message' => 'Login Error Please try again!', 'type'=> 'error']);
                }
            }else{
                return response()->json(['message' => 'Password number not match!', 'type'=> 'error']);
            }
        }else{
            $userDetailses = User::where('referral_id', $data['phone'])->first();
            $userDetailsesCount = User::where('referral_id', $data['phone'])->count();
            $userDetailsess = User::where('phone', $data['phone'])->first();


            if($userDetailsesCount ==1){
                if(isset($userDetailsess->phone) && $userDetailsess->phone == $data['phone']){
                    return response()->json(['message' => 'You need to account number for login !', 'type'=> 'error']);
                }

                if(isset($userDetailses->referral_id) &&  $userDetailses->referral_id == $data['phone']){
                    if(Hash::check($request->password, $userDetailses->password)){
                        if($token = $this->guard()->attempt(['referral_id' => $request->phone, 'password' => $request->password])){
                            $token = $this->respondWithToken($token);
                            $session_id = Cookie::get('session_id');
                            DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $this->guard()->user()->phone, 'user_type' =>  $this->guard()->user()->type]);

                            return response()->json(['token' =>$token, 'message'=> 'LogIn done Successfully!', 'type'=> 'success']);
                        }else{
                            return response()->json(["message" => "Login Error Please try again!", 'type'=> 'error']);
                        }
                    }else{
                        return response()->json()->with(["message" => "Password number not match!", 'type'=> 'error']);
                    }
                }else{
                    return response()->json(["message" => "Your Account Number is Wrong", 'type'=> 'error']);
                }
            }
            return response()->json(['message' => 'Unauthorized', 'type'=> 'error'], 401);
        }

    }



    public function register(Request $request){
        $data = $request->all();

        $this->validate($request,[
            'name'=>'required|max:250',
            'phone'=>'numeric|min:11',
            'password'=> 'required',
            'passwordCode'=> 'required|same:password',

        ]);

        if($data['introduce'] == ''){
            $data['introduce'] = '';
        }

        if($data['dealer'] == '' ){
            $data['dealer'] = '';
        }

        if($data['pincode'] == ''){
            $data['pincode'] = '';
        }



        if(!empty($data['pincode'])) {
            $referred_user = User::validateReferralId($data['introduce']);
            if ($referred_user) {
                $pincodeDetails = PackagePin::where('pincode', $data['pincode'])->count();
                $pincodeDetailss = PackagePin::where('pincode', $data['pincode'])->first();

                if ($pincodeDetails > 0) {
                    if ($pincodeDetailss->type == 'use') {
                        return response()->json(["Error" => "Pincode already used!"]);
                    } else {
                        if ($data['password'] == $data['passwordCode']) {
                            $referred_user = User::validateReferralId($data['introduce']);
                            $datas = explode("-", date('d-m-Y'));
                            $accountreforyou =  $datas[0] . $datas[1] . $datas[2] . rand(1111, 9999);;
                            $user = new User();
                            $user->name = $data['name'];
                            $user->phone = $data['phone'];
                            $user->password = bcrypt($data['password']);
                            $user->referred_by = $data['introduce'];
                            $user->referral_id = $accountreforyou;
                            $user->dealer_referral_by = $data['dealer'];
                            $user->type = 'BP';
                            $user->verified = 1;
                            $user->activation_date = date('Y-m-d');
                            $user->save();
                            PackagePin::where('pincode', $data['pincode'])->update(['type' => 'use','name'=> $data['name'], 'account'=> $accountreforyou]);
                            if ($referred_user) {
                                $referred_user->giveBpPackageBonus();
                            }
                            $comres = CommissionRegister::first();
                            $comision = new ComisionBonus();
                            $comision->referrel_id = $data['introduce'];
                            $comision->post_like = $comres->post_like;
                            $comision->post_comment = $comres->post_comment;
                            $comision->post_share = $comres->post_share;
                            $comision->incentive_reward = $comres->incentive_reward;
                            $comision->instant_bonus = $comres->instant_bonus;
                            $comision->daily_top_seller_bonus = $comres->daily_top_seller_bonus;
                            $comision->weakly_top_seller_bonus = $comres->weakly_top_seller_bonus;
                            $comision->monthly_top_seller_bonus = $comres->monthly_top_seller_bonus;
                            $comision->leader_bonus = $comres->leader_bonus;
                            $comision->dealer_point_bonus = $comres->dealer_point_bonus;
                            $comision->company_profit = $comres->company_profit;
                            $comision->reserved_fund = $comres->reserved_fund;
                            $comision->company_management = $comres->company_management;
                            $comision->daily_date = date('y-m-d');
                            $comision->save();


                            $userCollect = User::where('referral_id', $data['introduce'])->first();
                            $transactions = Transaction::where(['user_id'=> $userCollect->id, 'check_date'=> date('y-m-d')])->count();
                            $transactionsOld = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->count();
                            $transactionsdes = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->first();
                            $transactionsdlst = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->latest()->first();
                            if($transactionsOld > 0){


                                if( $transactionsdlst->check_date <= $transactionsdes->check_date->addDays(30)){
//
                                    if($transactions==0){
                                        if($referred_user){
                                            $referred_user->giveBpSignUpBonus();
                                        }
                                    }
                                }
                            }else{
                                if($transactions==0){
                                    if($referred_user){
                                        $referred_user->giveBpSignUpBonus();
                                    }
                                }
                            }


                            $userget = User::latest()->first();
                            if ($userget) {
                                if ($token = $this->guard()->attempt(['referral_id' => $userget->referral_id, 'password' => $request->password])) {
                                    $token = $this->respondWithToken($token);
                                    $session_id = Cookie::get('session_id');
                                    DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $this->guard()->user()->phone, 'user_type' =>  $this->guard()->user()->type]);
                                    return response()->json(['token' =>$token, 'message'=> 'LogIn done Successfully!', 'type'=> 'success']);
                                } else {
                                    return response()->json(["error" => "You use wrong account number !"]);
                                }
                            }
                            return response()->json(["success" => "Your Registration Successfully"]);
                        } else {
                            return response()->json(["Error" => "Password not match!"]);
                        }

                    }
                } else {
                    return response()->json(["Error" => "Pincode not available"]);
                }
            }else{
                return response()->json('Your Referral code is worng');
            }

        }else{
            $userDetails = User::where('phone', $data['phone'])->first();

            if($userDetails){
                return response()->json(["Error" => "User Already Added"]);
            }
            else{
                if($data['password'] == $data['passwordCode']){

                    $user = new User();
                    $user->name = $data['name'];
                    $user->phone = $data['phone'];
                    $user->password = bcrypt($data['password']);
                    $user->referred_by = $data['introduce'];
                    $user->dealer_referral_by = $data['dealer'];
                    $user->activation_date = date('Y-m-d');
                    $user->save();
                    if(!empty($data['introduce'])){
                        $referred_user = User::validateReferralId($data['introduce']);
                        $userCollect = User::where('referral_id',  $data['introduce'])->first();
                        $transactions = Transaction::where(['user_id'=> $userCollect->id, 'check_date'=> date('y-m-d')])->count();
                        $transactionsOld = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->count();
                        $transactionsdes = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->first();
                        $transactionsdlst = Transaction::where(['category'=> 'bp_signup_bonus', 'user_id'=> $userCollect->id])->latest()->first();
                        if($transactionsOld > 0){

                            if( $transactionsdlst->check_date <= $transactionsdes->check_date->addDays(30)){
//
                                if($transactions==0){
                                    if($referred_user){
                                        $referred_user->giveBpSignUpBonus();
                                    }
                                }
                            }
                        }else{
                            if($transactions==0){
                                if($referred_user){
                                    $referred_user->giveBpSignUpBonus();
                                }
                            }
                        }
                    }


                    if ($token = $this->guard()->attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
                        $token = $this->respondWithToken($token);
                        $session_id = Cookie::get('session_id');
                        DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $this->guard()->user()->phone, 'user_type' =>  $this->guard()->user()->type]);
                        return response()->json(['token' =>$token, 'message'=> 'LogIn done Successfully!', 'type'=> 'success']);
                    }

                    return response()->json(["success" => "User Successfully Added"]);
                }else{
                    return response()->json(["Error" => "Password not match!"]);
                }
            }
        }
    }



    public function userInfo($id){
        $user = User::where('id', $id)->select('id', 'name', 'profile_pic', 'referral_id', 'verified', 'doctor_service','phone', 'email', 'blood')->first();
        return response()->json($user);
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }



    public function getAuthUser()
    {
        return response()->json($this->guard()->user());
    }

    public function guard()
    {
        return Auth::guard('api');
    }



    public function isAuth()
    {
        if($this->guard()->check()) return true;
        return false;
    }
    public function userExists(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'device_id' => 'required',
        ]);

        $user_found = User::where('phone', $request->phone)->orWhere('device_id', $request->device_id)
            ->get()
            ->count();
        if($user_found) return "found";
        return "not-found";
    }
    public function validateReferralId($refid) {
        $data = User::validateReferralId($refid);
        if($data) {
            return "found";
        } else {
            return "not-found";
        }
    }


}
