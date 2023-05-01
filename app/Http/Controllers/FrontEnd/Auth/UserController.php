<?php

namespace App\Http\Controllers\FrontEnd\Auth;

use App\App\Model\ComisionBonus;
use App\App\Model\CommissionRegister;
use App\app\Model\IdCart;
use App\App\Models\PackagePin;
use App\Http\Controllers\Controller;
use App\Model\Marchant;
use App\Model\MarchantTransaction;
use App\Model\Matrix;
use App\Model\PaymentMethod\PaymentMethod;
use App\Model\ShoppingVoucherTransaction;
use App\Model\ShoppingWalletTransaction;
use App\Model\Transaction\Transaction;
use App\Model\User\UserVerification;
use App\Model\User\UserVerificationDetail;
use App\Model\Withdrawal\Withdrawal;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use phpseclib3\Math\BigInteger\Engines\PHP\Reductions\Barrett;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function updatedbaccount(Request $request){

        $user = User::where('id', $request->id)->first();
        $user->dealer_referral_id = $request->quantity;
        $user->save();
        return response()->json([
            'message' => 'Product Quantity Updated Successfully !'
        ]);

    }


    public function updatedbaccountBy(Request $request){

        $user = User::where('id', $request->id)->first();
        $user->dealer_referral_by = $request->dbaccountby;
        $user->save();
        return response()->json([
            'message' => 'Product Quantity Updated Successfully !'
        ]);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userRegister(Request $request){
        $data = $request->all();

        $this->validate($request,[
            'name'=>'required|max:20',
            'phone'=>'numeric|min:11',
            'password'=> 'required',
            'passwordCode'=> 'required|same:password',

        ]);

        if($data['introduce'] == ''){
            $data['introduce'] = '';
        }

        if($data['dealer'] == ''){
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
                    Toastr::error('Pincode already used!', 'Error');
                    return redirect()->back()->with(["Error" => "Pincode already used!"]);
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
                            if (Auth::attempt(['referral_id' => $userget->referral_id, 'password' => $request->password])) {
                                Session::put('frontSession', $data['password']);
                                if (!empty(Session::get('session_id'))) {
                                    $session_id = Session::get('session_id');
                                    DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $data['phone']]);
                                }

                                Toastr::success('You are login successfully', 'Success');
                                return redirect('/');
                            } else {
                                Toastr::error('You use wrong account number !', 'Error');
                                return redirect()->back()->with(["error" => "Login Error Please try again!"]);
                            }
                        }
                        Toastr::success('Your Registration successfully', 'Success');
                        return redirect()->back()->with(["success" => "User Successfully Added"]);
                    } else {
                        return redirect()->back()->with(["Error" => "Password not match!"]);
                    }

                }
            } else {
                return redirect()->back()->with(["Error" => "Pincode not available"]);
            }

        }else{
            Toastr::error('Your Referral code is worng', 'Error');
            return redirect()->back();
        }

        }else{
            $userDetails = User::where('phone', $data['phone'])->first();

            if($userDetails){
                return redirect()->back()->with(["Error" => "User Already Added"]);
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


                    if (Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {

                        Session::put('frontSession', $data['password']);
                        if(!empty(Session::get('session_id'))){
                            $session_id = Session::get('session_id');
                            DB::table('carts')->where(['session_id' => $session_id])->update(['user_email' => $data['email']]);
                        }
                        Toastr::success('Your Registration successfully', 'Success');
                        return redirect('/');
                    }


                    return redirect()->back()->with(["success" => "User Successfully Added"]);
                }else{
                    return redirect()->back()->with(["Error" => "Password not match!"]);
                }

            }
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userLogin(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'phone'=>'required',
            'password'=> 'required',
        ]);

        $userDetails = User::where('phone', $data['phone'])->count();


        $userusernameCount = User::where('username', $data['phone'])->count();
        $userusernameDetails = User::where('username', $data['phone'])->first();
        if($userusernameCount == 1){
            if(Hash::check($request->password, $userusernameDetails->password)){
                if(Auth::attempt(['username' => $request->phone, 'password' => $request->password])){
                    Session::put('frontSession', $data['password']);
                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => Auth::user()->phone]);
                        return redirect('/cart');
                    }
                    Toastr::success('You are login successfully', 'Success');
                    return redirect('/');
                }else{
                    Toastr::error('You use wrong account number !', 'Error');
                    return redirect()->back()->with(["error" => "Login Error Please try again!"]);
                }
            }else{
                Toastr::error('Your account number Wrong !', 'Error');
                return redirect()->back()->with(["error" => "Password number not match!"]);
            }
        }elseif($userDetails == 1){
            $userDetailses = User::where('phone', $data['phone'])->first();
            if(Hash::check($request->password, $userDetailses->password)){
                if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){
                    Session::put('frontSession', $data['password']);
                    if(!empty(Session::get('session_id'))){
                        $session_id = Session::get('session_id');
                        DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => Auth::user()->phone]);
                        return redirect('/cart');
                    }
                    Toastr::success('You are login successfully', 'Success');
                    return redirect('/');
                }else{
                    return redirect()->back()->with(["error" => "Login Error Please try again!"]);
                }
            }else{
                Toastr::error('Your account number Wrong !', 'Error');
                return redirect()->back()->with(["error" => "Password number not match!"]);
            }

        }else{

            $userDetailses = User::where('referral_id', $data['phone'])->first();
            $userDetailsesCount = User::where('referral_id', $data['phone'])->count();
            $userDetailsess = User::where('phone', $data['phone'])->first();

            if($userDetailsesCount ==1){
                if(isset($userDetailsess->phone) && $userDetailsess->phone == $data['phone']){
                    Toastr::error('You need to account number for login !', 'Error');
                    return redirect()->back();
                }

                if(isset($userDetailses->referral_id) &&  $userDetailses->referral_id == $data['phone']){
//               echo "<pre>"; print_r($request->all()); die;
                    if(Hash::check($request->password, $userDetailses->password)){
                        if(Auth::attempt(['referral_id' => $request->phone, 'password' => $request->password])){
                            Session::put('frontSession', $data['password']);
                            if(!empty(Session::get('session_id'))){
                                $session_id = Session::get('session_id');
                                DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => Auth::user()->phone]);
                                return redirect('/cart');
                            }
                            Toastr::success('You are login successfully', 'Success');
                            return redirect('/');
                        }else{
                            Toastr::error('You use wrong account number !', 'Error');
                            return redirect()->back()->with(["error" => "Login Error Please try again!"]);
                        }
                    }else{
                        Toastr::error('Your account number Wrong !', 'Error');
                        return redirect()->back()->with(["error" => "Password number not match!"]);
                    }
                }else{
                    Toastr::error('Your account number Wrong !', 'Error');

                    return redirect()->back()->with(["error" => "Your Account Number is Wrong"]);
                }

            }

            Toastr::error('You use wrong username or password !', 'Error');
            return redirect()->back();


        }





    }



    public function pinSubmit(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
//            echo "<pre>"; print_r($data);die;

            if (empty($data['introduce'])) {
                $data['introduce'] = '';
            }

            $pinCheck = PackagePin::where('pincode', $request['pin'])->count();
            $pinChecks = PackagePin::where('pincode', $request['pin'])->first();
            if ($pinCheck > 0) {
                if ($pinChecks->type == 'use') {
                    return redirect()->back();
                } else {
                    $userss = User::where('id', Auth::id())->first();
                    if ($userss->type == 'GU') {
                        $datas = explode("-", date('d-m-Y'));
                        $user = User::where('id', Auth::id())->update(['verified' => 1, 'referral_id' => $datas[0] . $datas[1] . $datas[2] . rand(1111, 9999), 'type' => 'BP']);
                        if ($user) {
                            $users = User::where('id', Auth::id())->first();
//                            dd($users->referral_id);
                            if ($users->referred_by == '') {
                                $referred_user = User::validateReferralId($data['introduce']);
                                if ($referred_user) {
                                    $referred_user->giveBpPackageBonus();
                                    PackagePin::where('pincode', $data['pin'])->update(['type' => 'use', 'name' => Auth::user()->name, 'account' => $data['introduce']]);
                                    User::where('id', Auth::id())->update(['referred_by' => $data['introduce'], 'activation_date'=> date('Y-m-d')]);
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

//                                    $userRefc = User::where('referral_id',  Auth::user()->referral_id)->count();
//                                    if($userRefc > 0){
//                                        $this->insert_into_matrix(Auth::id(), Auth::user()->referral_id);
//                                        $parent_id= $this->find_parent_id($data['introduce'], Auth::user()->referral_id);
//                                        $this->place_under_placement_id($parent_id,Auth::user()->referral_id);
//                                    }

                                    Toastr::success('You update your account successfully with referral', 'Success');
                                    return redirect()->back();
                                }
                            } else {
                                $referred_user = User::validateReferralId($users->referred_by);
                                if ($referred_user) {
                                    $referred_user->giveBpPackageBonus();
                                    if ($data['password'] == $data['passwordCode']) {
                                        User::where('id', Auth::id())->update(['activation_date'=> date('Y-m-d')]);
                                        PackagePin::where('pincode', $data['pin'])->update(['type' => 'use', 'name' => Auth::user()->name, 'account' => $users->referral_id]);
                                        $comres = CommissionRegister::first();
                                        $comision = new ComisionBonus();
                                        $comision->referrel_id = $users->referred_by;
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

//
//                                        $userRefc = User::where('referral_id',  Auth::user()->referral_id)->count();
//                                        if($userRefc > 0){
//                                            $this->insert_into_matrix(Auth::id(), Auth::user()->referral_id);
//                                            $parent_id= $this->find_parent_id($users->referred_by, Auth::user()->referral_id);
//                                            $this->place_under_placement_id($parent_id,Auth::user()->referral_id);
//                                        }

                                        Toastr::success('You update your account successfully', 'Success');
                                        return redirect()->back();
                                    }
                                }

                            }
                        } else {
                            return redirect()->back();
                        }

                    } else {
                        return redirect()->back();
                    }
                }
            }

        }

    }
    public function account(){

        return view('dealer.account');
    }

    public function eWallet(Request $request){
        $transactions = Transaction::where('user_id', Auth::user()->id);
        if($request->transaction != 'all'){
            if (isset($request->transaction) && !empty($request->transaction)) {
                $transactions = $transactions->where('transactions.category', $request->transaction);
            }
        }

        $transactions = $transactions->orderByDesc("id")->limit(32)->get();

        $payments = PaymentMethod::where('user_id', Auth::id())->get();
        $users = User::where('id', '!=', Auth::id())->where('type', '!=', 'GU')->get();
        $merchantUsers = Marchant::all();
        return view('frontend.user.user_transaction', compact('transactions', 'payments', 'users', 'merchantUsers'));
    }


    public function shoppingWallet(){
        $transactions = ShoppingVoucherTransaction::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        $merchantUsers = Marchant::all();
        return view('frontend.user.user_shopping_transaction', compact('transactions','merchantUsers'));
    }




    public function withdrawRequest(Request $request){
        if($request->isMethod('post')) {

            $userActive = User::where('id', Auth::id())->first();

            if($userActive->active === 0){

                $data = $request->all();
                $amount = ($data['amount'] *10)/100;

                $withdrawdetails = Withdrawal::where('user_id', Auth::id())->get();

                foreach ($withdrawdetails as $withdraws){
                    if($withdraws->status == 'pending'){
                        Toastr::error('Your withdraw request already added', 'Error');
                        return redirect('/e-wallet')->with(["success" => "Your withdraw request already added"]);
                        break;
                    }else{
                        continue;
                    }

                }

                $pendingTotal = Auth::user()->pendingBalance() + $data['amount'] + $amount;
                if($data['amount'] >= 800){
                    if (Auth::user()->balance() < $data['amount']+$amount || Auth::user()->balance() < $pendingTotal) {
                        return redirect('/e-wallet')->with(["success" => "Insufficient Balance"]);
                    } else {

                        $this->validate($request, [
                            'amount' => 'required',
                            'method' => 'required',
                        ]);

                        $withdraw = new Withdrawal();
                        $withdraw->user_id = Auth::id();
                        $withdraw->payment_method_id = $data['method'];
                        $withdraw->amount = $data['amount'];
                        $withdraw->status = 'pending';
                        $withdraw->save();
                        return redirect('/e-wallet');
                    }
                }else{
                    Toastr::error('Minimum Amount More Than 800 Tk for first Withdraw', 'Error');
                    return redirect()->back();
                }


            }else{

                $data = $request->all();
                $withdrawdetails = Withdrawal::where('user_id', Auth::id())->get();
                foreach ($withdrawdetails as $withdraws){
                    if($withdraws->status == 'pending'){
                        Toastr::error('Your withdraw request already added', 'Error');
                        return redirect('/e-wallet')->with(["success" => "Your withdraw request already added"]);
                        break;
                    }else{
                        continue;
                    }

                }
                $amount = ($data['amount'] * 10) / 100;

                $pendingTotal = Auth::user()->pendingBalance() + $data['amount'] + $amount;
                if($data['amount'] >= 500){
                    if (Auth::user()->balance() < $data['amount'] + $amount || Auth::user()->balance() < $pendingTotal) {
                        return redirect('/e-wallet')->with(["success" => "Insufficient Balance"]);
                    } else {

                        $this->validate($request, [
                            'amount' => 'required',
                            'method' => 'required',
                        ]);

                        $withdraw = new Withdrawal();
                        $withdraw->user_id = Auth::id();
                        $withdraw->payment_method_id = $data['method'];
                        $withdraw->amount = $data['amount'];
                        $withdraw->status = 'pending';
                        $withdraw->save();
                        return redirect('/e-wallet');
                    }
                }else{
                    Toastr::error('Minimum Amount More Than 500 Tk', 'Error');
                    return redirect()->back();
                }

            }


        }

    }


    public function addPayment(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request,[
                'method-add'=>'required',
                'method_name'=> 'required',
                'method_number'=> 'required',
            ]);

            $payment = new PaymentMethod();
            $payment->user_id = Auth::id();
            $payment->name = $data['method_name'];
            $payment->method = $data['method-add'];
            $payment->details = $data['method_number'];
            $payment->save();
            return redirect('/e-wallet');
        }
    }



    public function paymentShoppingBalance(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'amount' => 'required'
            ]);
            if(Auth::user()->active ==1){
                if(Hash::check($request->password, Auth::user()->password)) {
                    if (Auth::user()->shoppingWalletBalance() > $data['amount']) {

                        MarchantTransaction::create([
                            'user_id' => Auth::id(),
                            'referral_id' => Auth::user()->referral_id,
                            'category' => 'merchant_balance_transfer_sell_payment',
                            'amount_type' => 'c',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'Shopping Voucher Amount Convert To E-wallet',
                            'check_date' => date('Y-m-d')
                        ]);

                        ShoppingWalletTransaction::create([
                            'user_id' => Auth::id(),
                            'category' => 'merchant_balance_transfer_sell_payment',
                            'amount_type' => 'd',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'Shopping Voucher Amount Convert To E-wallet',
                            'check_date' => date('Y-m-d')
                        ]);

                        return redirect()->back();
                    } else {
                        Toastr::error('Insufficient balance!', 'Error');
                        return redirect()->back();
                    }
                }

            }

        }
    }



    public function sendBalance(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'username' => 'required',
                'amount' => 'required',
                'password' => 'required'
            ]);

            $userAuth = User::where(['id'=> Auth::id(), 'active'=> 1])->count();
            $userAuthDetails = User::where(['id'=> Auth::id(), 'active'=> 1])->first();
            $userSelect = User::where(['id'=> $data['username'], 'active'=> 1])->count();
            $userSelectDetails = User::where(['id'=> $data['username'], 'active'=> 1])->first();
            $amount = ($data['amount'] * 1) / 100;

            if(Auth::user()->balance() > $data['amount'])
            {
                if($userAuth > 0 && $userSelect > 0){
                    if(Hash::check($request->password, $userAuthDetails->password)) {

                        if ($data['amount'] >= 100) {
                            Transaction::create([
                                'user_id' => Auth::id(),
                                'category' => 'balance_transfer_user',
                                'amount_type' => 'd',
                                'amount' => $data['amount'] + $amount,
                                'data' => '',
                                'message' => 'You send balance to ' . $userSelectDetails->name,
                                'check_date' => date('Y-m-d')
                            ]);

                            Transaction::create([
                                'user_id' => $data['username'],
                                'category' => 'balance_transfer_user',
                                'amount_type' => 'c',
                                'amount' => $data['amount'] - $amount,
                                'data' => '',
                                'message' => 'You received balance by ' . Auth::user()->name,
                                'check_date' => date('Y-m-d')
                            ]);
                            Toastr::success('Balance send successfully', 'Success');

                            return redirect()->back();
                        }
                    }else{
                        Toastr::error('Password Not Match', 'Error');
                        return redirect()->back();
                    }
                }else{
                    Toastr::error('Account Not Activated', 'Error');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Insufficient balance!', 'Error');
                return redirect()->back();
            }



        }
    }


    public function sendShoppingBalance(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'amount' => 'required'
            ]);
            if(Hash::check($request->password, Auth::user()->password)) {
                if (Auth::user()->shoppingVoucherBalance() > $data['amount']) {
                    $eWallet = ($data['amount'] * 75) / 100;
                    $eWalletShopping = ($data['amount'] * 25) / 100;

                    Transaction::create([
                        'user_id' => Auth::id(),
                        'category' => 'shopping_voucher_amount_convert_to_e_wallet',
                        'amount_type' => 'c',
                        'amount' => $eWallet,
                        'data' => '',
                        'message' => 'Shopping Voucher Amount Convert To E-wallet',
                        'check_date' => date('Y-m-d')
                    ]);

                    ShoppingVoucherTransaction::create([
                        'user_id' => Auth::id(),
                        'category' => 'shopping_voucher_amount_convert_to_e_wallet',
                        'amount_type' => 'd',
                        'amount' => $data['amount'],
                        'data' => '',
                        'message' => 'Shopping Voucher Amount Convert To E-wallet',
                        'check_date' => date('Y-m-d')
                    ]);

                    ShoppingWalletTransaction::create([
                        'user_id' => Auth::id(),
                        'category' => 'shopping_voucer_amount_convert_to_e_wallet',
                        'amount_type' => 'c',
                        'amount' => $eWalletShopping,
                        'data' => '',
                        'message' => 'Shopping Voucher Amount Convert To E-wallet',
                        'check_date' => date('Y-m-d')
                    ]);
                    return redirect()->back();
                } else {
                    Toastr::error('Insufficient balance!', 'Error');
                    return redirect()->back();
                }
            }

        }
    }


    public function checkUserForName(Request $request){
        $userCount = User::where('referral_id', $request->value)->count();

        if($userCount == 1){
          $user = User::where('referral_id', $request->value)->first();
          return response()->json([
              'user'=> $user
          ]);
        }else{
            return response()->json([
                'message'=> 'User Not Found'
            ]);

        }
    }





    public function userFormVerification(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request,[
                'introducer'=>'required',
                'ssc_roll_number'=> 'required',
                'ssc_registration_number'=> 'required',
                'group'=> 'required',
                'year'=> 'required',
                'board'=> 'required',
                'payment'=> 'required',
                'payment_number'=> 'required',
                'transactionid'=> 'required',
                'size'=> 'required',
                'address'=> 'required',
                'email'=> 'required',
            ]);

            $user = new UserVerification();
            $user->user_id = Auth::id();
            $user->status = "pending";
            $user->method = $data['method-add'];
            $user->verified_date = null;
            $user->payment_method = $data['payment'];
            $user->payment_details = $data['payment_number'];
            $user->transaction_id = $data['transactionid'];
            $user->logistics_address = $data['address'];
            $user->t_shirt_size = $data['size'];
            $user->save();

            $userDetails = new UserVerificationDetail();
            $userDetails->user_id = Auth::id();
            $userDetails->email = $data['email'];
            $userDetails->education = 'SSC';
            $userDetails->board = $data['board'];
            $userDetails->roll = $data['ssc_roll_number'];
            $userDetails->reg_num = $data['ssc_registration_number'];
            $userDetails->group = $data['group'];
            $userDetails->year = $data['year'];
            $userDetails->save();
            return redirect()->back();
        }
        return view('frontend.user.verification');
    }



    public function userIdCart(Request $request){

        if($request->isMethod('post')){
            $countCart = IdCart::where(['status'=> 'pending', 'user_id' => Auth::id()])->count();

            if($countCart  == 0) {
                $data = $request->all();
                if ($request->image_upload) {
                    $image_tmp = $request->image_upload;

                    $path = 'media/cart' . '/' . Auth::id() . '/';
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $large_image_path = 'media/cart' . '/' . Auth::id() . '/' . $image_tmp;
                    Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
                }

                $idCart = new IdCart();
                $idCart->user_id = Auth::id();
                $idCart->account = $data['account'];
                $idCart->email = $data['email'];
                $idCart->phone = $data['phone'];
                $idCart->blood = $data['blood'];
                $idCart->image = $image_tmp;
                $idCart->status = 'pending';
                $idCart->validate_date = date('Y-m-d', strtotime("-30 day"));
                $idCart->save();
                return redirect()->back();
            }else{
                Toastr::error('You already Applied', 'Error');
                return redirect()->back();
            }
        }


        $countCart = IdCart::where(['status'=> 'complete', 'user_id' => Auth::id()])->where('validate_date','<=', date('Y-m-d',strtotime("365 day")))->count();
        $countCartfirst = IdCart::where(['status'=> 'complete', 'user_id' => Auth::id()])->where('validate_date','<=', date('Y-m-d',strtotime("365 day")))->first();
        return view('frontend.user.idcard', compact('countCart','countCartfirst'));
    }

    public function userIdCartForm(Request $request){
        $data = $request->all();
//        echo "<pre>"; print_r($data); die;
        if(isset($data["image"]))
        {
            $data = $data["image"];

            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = time() . '.png';

            file_put_contents($imageName, $data);

            echo '<img src="'.$imageName.'" class="img-thumbnail" /><input type="hidden" name="image_upload" value="'.$imageName.'">';
        }
    }


public function referralCode(Request $request, $code){

        if($request->isMethod('post')){
            $data = $request->all();

//            echo "<pre>"; print_r($code); die;
            $this->validate($request,[
                'name'=>'required|max:20',
                'phone'=>'numeric|min:11',
                'password'=> 'required',
                'passwordCode'=> 'required|same:password',

            ]);

            if($data['pincode'] == ''){
                $data['pincode'] = '';
            }

            if($data['dealer'] == ''){
                $data['dealer'] = '';
            }

            $checkReferralUser = User::where('referral_id', $code)->count();
            if($checkReferralUser == 1) {
                if (!empty($data['pincode'])) {

                    $pincodeDetails = PackagePin::where('pincode', $data['pincode'])->count();
                    $pincodeDetailss = PackagePin::where('pincode', $data['pincode'])->first();

                    if ($pincodeDetails > 0) {
                        if ($pincodeDetailss->type == 'use') {
                            Toastr::error('Pincode already used!', 'Error');
                            return redirect()->back()->with(["Error" => "Pincode already used!"]);
                        } else {

                            if ($data['password'] == $data['passwordCode']) {

                                $datas = explode("-", date('d-m-Y'));

                                PackagePin::where('pincode', $data['pincode'])->update(['type' => 'use', 'name' => $data['name'], 'account' => $datas[0] . $datas[1] . $datas[2] . rand(1111, 9999)]);

                                $referred_user = User::validateReferralId($code);
                                $user = new User();
                                $user->name = $data['name'];
                                $user->phone = $data['phone'];
                                $user->password = bcrypt($data['password']);
                                $user->referred_by = $code;
                                $user->referral_id = $datas[0] . $datas[1] . $datas[2] . rand(1111, 9999);
                                $user->dealer_referral_by = $data['dealer'];
                                $user->type = 'BP';
                                $user->verified = 1;
                                $user->save();
                                if ($referred_user) {
                                    $referred_user->giveBpPackageBonus();
                                }
                                $comres = CommissionRegister::first();
                                $comision = new ComisionBonus();
                                $comision->referrel_id = $code;
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


                                $userCollect = User::where('referral_id', $code)->first();
                                $transactions = Transaction::where(['user_id' => $userCollect->id, 'check_date' => date('y-m-d')])->count();
                                $transactionsOld = Transaction::where(['category' => 'bp_signup_bonus', 'user_id' => $userCollect->id])->first();
                                if (isset($transactionsOld)) {
                                    if ($transactionsOld->created_at <= $transactionsOld->created_at->addMonths(1)) {
//
                                        if ($transactions == 0) {
                                            if ($referred_user) {
                                                $referred_user->giveBpSignUpBonus();
                                            }
                                        }
                                    }
                                } else {
                                    if ($transactions == 0) {
                                        if ($referred_user) {
                                            $referred_user->giveBpSignUpBonus();
                                        }
                                    }
                                }

                                $userget = User::latest()->first();
                                if ($userget) {
                                    if (Auth::attempt(['referral_id' => $userget->referral_id, 'password' => $request->password])) {
                                        Session::put('frontSession', $data['password']);
                                        if (!empty(Session::get('session_id'))) {
                                            $session_id = Session::get('session_id');
                                            DB::table('carts')->where(['session_id' => $session_id])->update(['user_phone' => $data['phone']]);
                                        }
                                        Toastr::success('You are login successfully', 'Success');
                                        return redirect('/');
                                    } else {
                                        Toastr::error('You use wrong account number !', 'Error');
                                        return redirect()->back()->with(["error" => "Login Error Please try again!"]);
                                    }
                                }
                                Toastr::success('Your Registration successfully', 'Success');
                                return redirect()->back()->with(["success" => "User Successfully Added"]);
                            } else {
                                return redirect()->back()->with(["Error" => "Password not match!"]);
                            }

                        }
                    } else {
                        return redirect()->back()->with(["Error" => "Pincode not available"]);
                    }

                } else {
                    $userDetails = User::where('phone', $data['phone'])->first();

                    if ($userDetails) {
                        return redirect()->back()->with(["Error" => "User Already Added"]);
                    } else {
                        if ($data['password'] == $data['passwordCode']) {

                            $user = new User();
                            $user->name = $data['name'];
                            $user->phone = $data['phone'];
                            $user->password = bcrypt($data['password']);
                            $user->referred_by = $code;
                            $user->dealer_referral_by = $data['dealer'];

                            $user->save();
                            if (!empty($code)) {
                                $referred_user = User::validateReferralId($code);

                                $userCollect = User::where('referral_id', $code)->first();
                                $transactions = Transaction::where(['user_id' => $userCollect->id, 'check_date' => date('y-m-d')])->count();
                                $transactionsOld = Transaction::where(['category' => 'bp_signup_bonus', 'user_id' => $userCollect->id])->first();
                                if (isset($transactionsOld)) {


                                    if ($transactionsOld->created_at <= $transactionsOld->created_at->addMonths(1)) {
//
                                        if ($transactions == 0) {
                                            if ($referred_user) {
                                                $referred_user->giveBpSignUpBonus();
                                            }
                                        }
                                    }
                                } else {
                                    if ($transactions == 0) {
                                        if ($referred_user) {
                                            $referred_user->giveBpSignUpBonus();
                                        }
                                    }
                                }
                            }


                            if (Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {

                                Session::put('frontSession', $data['password']);
                                if (!empty(Session::get('session_id'))) {
                                    $session_id = Session::get('session_id');
                                    DB::table('carts')->where(['session_id' => $session_id])->update(['user_email' => $data['email']]);
                                }
                                Toastr::success('Your Registration successfully', 'Success');
                                return redirect('/');
                            }


                            return redirect()->back()->with(["success" => "User Successfully Added"]);
                        } else {
                            return redirect()->back()->with(["Error" => "Password not match!"]);
                        }

                    }
                }

            }else{
                Toastr::error('Your Referral Code is Wrong');
                return redirect()->back();
            }




        }

        return view('frontend.auth.login');
}



    public function updateUserAccount(Request $request){
            if($request->isMethod('post')){
                $accountCheck = User::where('username', $request->introduce)->count();
                if ($accountCheck == 0){
                    User::where("id", Auth::id())->update(['username'=> $request->introduce]);
                    Toastr::success('Your account updated successfully done!', 'Success');
                    return redirect()->back();
                }else{
                    Toastr::error('This User Name Already Taken. Try again! ', 'Error');
                    return redirect()->back();
                }
            }
    }


    public function getMerchant(){

        $transactions = MarchantTransaction::where('user_id', Auth::id())->orderByDesc('id')->get();
        $users = User::where('type','!=', 'GU')->get();
//            $users = json_decode(json_encode($users));
//            echo "<pre>"; print_r($users);die;
        return view('frontend.user.merchant_wallet', compact('transactions', 'users'));
    }




    public function sellMerchantBalance(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request, [
                'username' => 'required',
                'amount' => 'required',
                'password' => 'required'
            ]);

            $userAuthDetails = User::where('id', Auth::id())->first();
            $username = explode('-', $data['username']);
            $selectUser = User::where('id', $username[0])->first();

            if(Hash::check($request->password, $userAuthDetails->password)){
                if($data['amount'] >= 100){
                    if($userAuthDetails->merchantBalance() >= $data['amount']){
                        Transaction::create([
                            'user_id' => $username[0],
                            'category' => 'merchant_balance_transfer',
                            'amount_type' => 'c',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'You received balance to ' . $userAuthDetails->name,
                            'check_date' => date('Y-m-d')
                        ]);


                        MarchantTransaction::create([
                            'user_id' => Auth::id(),
                            'referral_id' => $userAuthDetails->referral_id,
                            'category' => 'merchant_balance_transfer_sell',
                            'amount_type' => 'd',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'You sell balance to ' . $selectUser->name,
                            'check_date' => date('Y-m-d')
                        ]);
                        Toastr::success('Successfully Balance Transaction', 'Success');
                        return redirect()->back();

                    }else{
                        Toastr::error('Insufficient Balance', 'Error');
                        return redirect()->back();
                    }
                }else{
                    Toastr::error('Amount more than 100 tk', 'Error');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Password not match', 'Error');
                return redirect()->back();
            }

            return redirect()->back();
        }
    }



    public function paymentMerchantBalance(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'username' => 'required',
                'amount' => 'required',
                'password' => 'required'
            ]);

            $userAuthDetails = User::where('id', Auth::id())->first();
            $selectUser = User::where('id', $data['username'])->first();
            $mercentD = Marchant::where('user_id', $data['username'])->first();

            $amount = ($data['amount'] *$mercentD->payment_charge) /100;

            if (Hash::check($request->password, $userAuthDetails->password)) {
                if($userAuthDetails->balance()> $data['amount']){
                    Transaction::create([
                        'user_id' => Auth::id(),
                        'category' => 'merchant_balance_transfer',
                        'amount_type' => 'd',
                        'amount' => $data['amount'],
                        'data' => '',
                        'message' => 'You send balance to ' . $selectUser->name,
                        'check_date' => date('Y-m-d')
                    ]);


                    MarchantTransaction::create([
                        'user_id' => $data['username'],
                        'category' => 'merchant_balance_transfer_payment',
                        'amount_type' => 'c',
                        'amount' => $data['amount'] - $amount,
                        'data' => '',
                        'message' => 'You received balance to ' . Auth::user()->name,
                        'check_date' => date('Y-m-d')
                    ]);


                    MarchantTransaction::create([
                        'user_id' => $data['username'],
                        'category' => 'merchant_balance_transfer_payment',
                        'amount_type' => 'd',
                        'amount' => $amount,
                        'data' => '',
                        'message' => 'Merchant payment commission for admin',
                        'check_date' => date('Y-m-d')
                    ]);

                    Toastr::success('Successfully balance transaction', 'Success');
                    return redirect()->back();
                }else{
                    Toastr::error('Insufficient Balance', 'Error');
                    return redirect()->back();
                }

            }else{
                Toastr::error('Password not match', 'Error');
                return redirect()->back();
            }
        }
    }




    public function UpdateUserAllInformation(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request, [
                'name' => 'required',
                'occupation' => 'required',
                'birthday' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'cur_address' => 'required',
                'home_address' => 'required',
                'blood' => 'required',
            ]);

            User::where('id', Auth::id())->update(['name' => $data['name'], 'occupation' => $data['occupation'], 'birthday' => $data['birthday'], 'gender' => $data['gender'], 'religion' => $data['religion'], 'hometown' => $data['home_address'], 'lives_in' => $data['cur_address'], 'blood' => $data['blood']]);
            return redirect()->back();

        }
        return view('frontend.user.update_user_all_information');
    }



    protected  function place_under_placement_id($parent_id, $agent_id){
        $data = Matrix::where('referral_id', $parent_id)->first();
        $position = ($data->left_position == null) ? 'left_position':(($data->middle_position == null)? 'middle_position': 'right_position');
        Matrix::where('referral_id', $agent_id)->update(['parent_id'=> $parent_id]);
        Matrix::where('referral_id', $parent_id)->update([$position=> $agent_id]);

    }

    protected function insert_into_matrix($agent_id1, $agent_id2){
        $matrix = new Matrix();
        $matrix->user_id =$agent_id1;
        $matrix->referral_id = $agent_id2;
        $matrix->save();
    }

    protected  function find_parent_id($my_id, $agent_id2){
        $arr = [$my_id];
        while (!empty($arr)){
            $temp_array = [];

            for ($i = 0; $i < count($arr); $i++){
                if($this->check_place_available_or_not($arr[$i])){
                    return $arr[$i];
                }else{
                    $id = $arr[$i];
                    $data = Matrix::where('referral_id', $id)->first();

                    $left_id = $data->left_position;
                    $middle_id = $data->middle_position;
                    $right_id = $data->right_position;
                    array_push($temp_array, $left_id, $middle_id, $right_id);
                }
            }
            $arr = $temp_array;
        }
    }

    protected function check_place_available_or_not($agent_id){
        $data = Matrix::where('referral_id', $agent_id)->first();
        if($data->left_position == null || $data->middle_position == null || $data->right_position == null){
            return true;
        }else{
            return false;
        }
    }







    public function walletUser(){
        return view('frontend.wallet.wallet');
    }

    public function cashbackUser(){
        return view('frontend.wallet.cashback');
    }

    public function dealerUser(){
        return view('frontend.wallet.dealer');
    }


    public function dealerPurchase(){
        return view('frontend.dealer.purchase');
    }

    public function dealerOrders(){
        return view('frontend.dealer.order');
    }


    public function dealerWallet(){
        return view('frontend.dealer.wallet');
    }


    public function dealerBonus(){
        return view('frontend.dealer.bonus');
    }

    public function profileDetails(){
        return view('frontend.user.profile');
    }


    public function verification(){
        return view('frontend.user.verification');
    }



    public function applyForDealer(){
        return view('frontend.user.apply_for_bp');
    }





}
