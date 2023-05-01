<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Model\Marchant;
use App\Model\MarchantTransaction;
use App\Model\PaymentMethod\PaymentMethod;
use App\Model\ShoppingVoucherTransaction;
use App\Model\ShoppingWalletTransaction;
use App\Model\Transaction\Transaction;
use App\Model\Withdrawal\Withdrawal;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    public function getEWallet(Request $request){
        $transactions = Transaction::where('user_id', Auth::id())->orderByDesc("id")->paginate(20);
        $userBalance = round( Auth::user()->balance(), 2);
        $penddingBalance = round( Auth::user()->pendingBalance(), 2);
        return response()->json([
            'transactions' => $transactions,
            'balance' => $userBalance,
            'pending_balance' => $penddingBalance,
        ]);
    }

    public function getEWalletUserInfo(){

        $payments = PaymentMethod::where('user_id', Auth::id())->get();
        $users = User::where('id', '!=', Auth::id())->where('type', '!=', 'GU')->select('id', 'name', 'referral_id')->get();
        $merchantUsers = Marchant::all();

        return response()->json([
            'payments' => $payments,
            'users' => $users,
            'merchantUsers' => $merchantUsers,

        ]);
    }

    public function getShoppingWallet(){
      $shoppingBalance =   round(Auth::user()->shoppingVoucherBalance(), 2);
      $shoppingWallet =  round(Auth::user()->shoppingWalletBalance(), 2);
      $transactions = ShoppingVoucherTransaction::where('user_id', Auth::id())->orderByDesc("id")->paginate(20);
        return response()->json([
            'transactions' => $transactions,
            'shoppingBalance' => $shoppingBalance,
            'shoppingWallet' => $shoppingWallet,
        ]);
    }


    public function addPaymentWallet(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'method_type'=>'required',
            'method_name'=> 'required',
            'method_number'=> 'required',
        ]);

        $payment = new PaymentMethod();
        $payment->user_id = Auth::id();
        $payment->name = $data['method_name'];
        $payment->method = $data['method_type'];
        $payment->details = $data['method_number'];
        $payment->save();
        return response()->json($payment);

    }

    public function getPaymentWallet($id){
        $payment_method = PaymentMethod::where('user_id', $id)->get();
        return response()->json($payment_method);
    }

    public function getPaymentWithdrawRequest(Request $request){
        if($request->isMethod('post')) {
            $userActive = User::where('id', Auth::id())->first();

            if(Hash::check($request->withdraw_password, $userActive->password)) {

                $data = $request->all();
                $withdrawdetails = Withdrawal::where('user_id', Auth::id())->get();

//                foreach ($withdrawdetails as $withdraws){
//                    if($withdraws->status == 'pending'){
//                        return response()->json(['message' => 'Your withdraw request already added']);
//                        break;
//                    }else{
//                        continue;
//                    }
//
//                }

                $pendingTotal = Auth::user()->pendingBalance() + $data['withdraw_amount'];

                if ($userActive->active === 0) {

                    if ($data['withdraw_amount'] >= 800) {
                        if (Auth::user()->balance() < $data['withdraw_amount'] || Auth::user()->balance() < $pendingTotal) {
                            return response()->json(['message' => 'Insufficient Balance', 'type' => 'error']);
                        } else {

                            $this->validate($request, [
                                'withdraw_method' => 'required',
                                'withdraw_amount' => 'required',
                            ]);

                            $withdraw = new Withdrawal();
                            $withdraw->user_id = Auth::id();
                            $withdraw->payment_method_id = $data['withdraw_method'];
                            $withdraw->amount = $data['withdraw_amount'];
                            $withdraw->status = 'pending';
                            $withdraw->save();
                            return response()->json(['message' => 'Withdraw Request Successfully Done', 'type' => 'success']);
                        }
                    } else {
                        return response()->json(['message' => 'Minimum Amount More Than 800 Tk for first Withdraw', 'type' => 'error']);

                    }

                } else {

                    if ($data['withdraw_amount'] >= 500) {
                        if (Auth::user()->balance() < $data['withdraw_amount'] || Auth::user()->balance() < $pendingTotal) {
                            return response()->json(['message' => 'Insufficient Balance', 'type' => 'error']);

                        } else {

                            $this->validate($request, [
                                'withdraw_amount' => 'required',
                                'withdraw_method' => 'required',
                            ]);

                            $withdraw = new Withdrawal();
                            $withdraw->user_id = Auth::id();
                            $withdraw->payment_method_id = $data['withdraw_method'];
                            $withdraw->amount = $data['withdraw_amount'];
                            $withdraw->status = 'pending';
                            $withdraw->save();
                            return response()->json(['message' => 'Withdraw Request Successfully Done', 'type' => 'success']);
                        }
                    } else {
                        return response()->json(['message' => 'Minimum Amount More Than 500 Tk', 'type' => 'error']);

                    }
                }
            }else{
                return response()->json(['message' => 'Incorrect Password', 'type' => 'error']);

            }
        }
    }


    public function sendPaymentRequest(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'user_name' => 'required',
                'amount' => 'required',
                'password' => 'required'
            ]);

            $userAuth = User::where(['id'=> Auth::id(), 'active'=> 1])->count();
            $userAuthDetails = User::where(['id'=> Auth::id(), 'active'=> 1])->first();
            $userSelect = User::where(['id'=> $data['user_name'], 'active'=> 1])->count();
            $userSelectDetails = User::where(['id'=> $data['user_name'], 'active'=> 1])->first();
            $amount = ($data['amount'] * 1) / 100;

            if(Auth::user()->balance() > $data['amount'])
            {
                if($userAuth > 0 && $userSelect > 0){
                    if(Hash::check($request->password, $userAuthDetails->password)) {

                        if ($data['amount'] >= 100) {
                          $value =   Transaction::create([
                                'user_id' => Auth::id(),
                                'category' => 'balance_transfer_user',
                                'amount_type' => 'd',
                                'amount' => $data['amount'] + $amount,
                                'data' => '',
                                'message' => 'You send balance to ' . $userSelectDetails->name,
                                'check_date' => date('Y-m-d')
                            ]);

                            Transaction::create([
                                'user_id' => $data['user_name'],
                                'category' => 'balance_transfer_user',
                                'amount_type' => 'c',
                                'amount' => $data['amount'] - $amount,
                                'data' => '',
                                'message' => 'You received balance by ' . Auth::user()->name,
                                'check_date' => date('Y-m-d')
                            ]);
                            return response()->json(['data'=> $value,'message' => 'Balance send successfully', 'type' => 'success']);
                        }
                    }else{

                        return response()->json(['message' => 'Password Not Match', 'type' => 'error']);
                    }
                }else{

                    return response()->json(['message' => 'Account Not Activated', 'type' => 'error']);
                }
            }else{

                return response()->json(['message' => 'Insufficient balance!', 'type' => 'error']);

            }

        }
    }

    public function sendPaymentRequestMarchent(Request $request){
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
                if($userAuthDetails->balance() > $data['amount']){
                   $value = Transaction::create([
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

                    return response()->json(['data'=> $value,'message' => 'Successfully balance transaction', 'type' => 'success']);
                }else{
                    return response()->json(['message' => 'Insufficient Balance', 'type' => 'error']);
                }

            }else{
                return response()->json(['message' => 'Password not match', 'type' => 'error']);
            }
        }
    }

    public function getMarchentUserInfo(){
        $merchetUsers = Marchant::all();
        return response()->json($merchetUsers);
    }
    public function getShoppingWalletToBvonBalance(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'amount' => 'required'
            ]);


            $usersMarchent = User::where('id', $request->username)->first();

            if(Auth::user()->active ==1){
                if(Hash::check($request->password, Auth::user()->password)) {
                    if (Auth::user()->shoppingWalletBalance() > $data['amount']) {

                        MarchantTransaction::create([
                            'user_id' => $request->username,
                            'referral_id' =>$usersMarchent->referral_id,
                            'category' => 'merchant_balance_transfer_sell_payment',
                            'amount_type' => 'c',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'This amount form Shopping Voucher',
                            'check_date' => date('Y-m-d')
                        ]);

                       $value =  ShoppingVoucherTransaction::create([
                            'user_id' => Auth::id(),
                            'category' => 'merchant_balance_transfer_sell_payment',
                            'amount_type' => 'd',
                            'amount' => $data['amount'],
                            'data' => '',
                            'message' => 'Shopping Voucher Amount Convert To Marchant Amount',
                            'check_date' => date('Y-m-d')
                        ]);
                        return response()->json(['data' => $value, 'message' => 'Successfully send balance!', 'type' => 'success']);
                    } else {
                        return response()->json(['message' => 'Insufficient balance!', 'type' => 'error']);
                    }
                }else{
                    return response()->json(['message' => 'Password Not Match!', 'type' => 'error']);
                }

            }

        }
    }

    public function getShoppingWalletToEWallet(Request $request){
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

                  $value =  ShoppingVoucherTransaction::create([
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
                    return response()->json(['data' => $value, 'message' => 'Request Successfully done', 'type' => 'success']);
                } else {
                    return response()->json(['message' => 'Insufficient balance!', 'type' => 'error']);
                }
            }

        }
    }



public function getMarchentTransactions(){
    $transactions = MarchantTransaction::where('user_id', Auth::id())->orderByDesc('id')->paginate(20);

    $marchantBalance = round(Auth::user()->merchantBalance(), 2);
    return response()->json([
        'transactions' => $transactions,
        'marchantBalance' => $marchantBalance
    ]);
}

public function getUserInfo(){
    $users = User::where('type','!=', 'GU')->get();
    return $users;
}

public function marchentTransactionsRequest(Request $request){
    if($request->isMethod('post')){
        $data = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required',
            'password' => 'required'
        ]);

        $userAuthDetails = User::where('id', Auth::id())->first();
        $selectUser = User::where('id',$data['username'])->first();

        if(Hash::check($request->password, $userAuthDetails->password)){
            if($data['amount'] >= 100){
                if($userAuthDetails->merchantBalance() >= $data['amount']){
                    Transaction::create([
                        'user_id' => $data['username'],
                        'category' => 'merchant_balance_transfer',
                        'amount_type' => 'c',
                        'amount' => $data['amount'],
                        'data' => '',
                        'message' => 'You received balance to ' . $userAuthDetails->name,
                        'check_date' => date('Y-m-d')
                    ]);


                   $value = MarchantTransaction::create([
                        'user_id' => Auth::id(),
                        'referral_id' => $userAuthDetails->referral_id,
                        'category' => 'merchant_balance_transfer_sell',
                        'amount_type' => 'd',
                        'amount' => $data['amount'],
                        'data' => '',
                        'message' => 'You sell balance to ' . $selectUser->name,
                        'check_date' => date('Y-m-d')
                    ]);
                    return response()->json(['data'=> $value, 'message' => 'Successfully Balance Transaction', 'type' => 'success']);

                }else{
                    return response()->json(['message' => 'Insufficient Balance', 'type' => 'error']);
                }
            }else{
                return response()->json(['message' => 'Amount more than 100 tk', 'type' => 'error']);
            }
        }else{
            return response()->json(['message' => 'Password not match', 'type' => 'error']);

        }

    }
}










}
