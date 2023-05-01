<?php

namespace App\Http\Controllers\Dashboard\Merchant;

use App\Http\Controllers\Controller;
use App\Model\Marchant;
use App\Model\MarchantTransaction;
use App\User;
use Illuminate\Http\Request;

class MerchantAccountController extends Controller
{
    public function index(){
        $merchants = Marchant::orderBy('id', 'desc')->get();
        return view('dashboard.merchant.merchant', compact('merchants'));
    }

    public function addAccount(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'referred_id' => 'required',
                'address' => 'required',
                'type' => 'required',
                'merchant_name' => 'required',
                'email' => 'required',
                'payment_charge' => 'required',
                'password' => 'required|required_with:password_confirmation|same:password_confirmation'
            ]);
            $account = explode("-", $data['referred_id']);
            $datas = explode("-", date('d-m-Y'));
            $merchant = new Marchant();

            $merchant->user_id = $account[0];
            $merchant->referral_id = $account[1];
            $merchant->address = $data['address'];
            $merchant->merchant_name = $data['merchant_name'];
            $merchant->type = $data['type'];
            $merchant->email = $data['email'];
            $merchant->password = bcrypt($data['password']);
            $merchant->merchant_account = $datas[0].$datas[1].$datas[2]. rand(1111, 9999);
            $merchant->payment_charge = $data['payment_charge'];
            $merchant->save();

            return redirect('dashboard/vendor_merchant/merchant')->with(['message'=> 'Merchant Account Created Successfully!']);

        }

        $users = User::where('type', '!=', 'GU')->get();
        return view('dashboard.merchant.add_merchant', compact('users'));
    }


    public function editAccount(Request $request, $id){

        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'referred_id' => 'required',
                'address' => 'required',
                'type' => 'required',
                'merchant_name' => 'required',
                'email' => 'required',
                'payment_charge' => 'required'
                 ]);
            $account = explode("-", $data['referred_id']);

            Marchant::where('id', $id)->update(['user_id'=> $account[0], 'referral_id' => $account['1'], 'address' => $data['address'], 'type' => $data['type'], 'merchant_name'=> $data['merchant_name'], 'email' => $data['email'], 'payment_charge' => $data['payment_charge']]);
            return redirect('dashboard/vendor_merchant/merchant')->with(['message' => 'Merchant Account Update Successfully']);

        }
        $merchant = Marchant::where('id', $id)->first();
        $users = User::where('type', '!=', 'GU')->get();
        return view('dashboard.merchant.edit_merchant',compact('merchant', 'users'));
    }

    public function deleteAccount(Request $request){
        Marchant::where('id', $request->id)->delete();
        return response()->json();
    }

    public function merchantAccountHistory($id){
        $transctions = MarchantTransaction::where('user_id', $id)->paginate(20);
        $user = User::where('id',$id)->first();

        return view('dashboard.merchant.merchant_history', compact('transctions', 'user', "id"));
    }


    public function addBalanceMerchant(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $marchant = Marchant::where('user_id', $request->id)->first();
//            echo "<pre>"; print_r($marchant); die;

            $request->validate([
                'amount_type' => 'required',
                'amount' => 'required'
            ]);

            MarchantTransaction::create([
                "user_id" => $marchant->user_id,
                "referral_id" => $marchant->referral_id,
                "category" => "merchant_payment_from_admin",
                "amount_type" =>$data['amount_type'],
                "amount" => $data["amount"],
                "data" =>'',
                "message" => "MerChant Payment From Admin",
                "check_date" => date('Y-m-d'),
            ]);

            return redirect()->back();
        }
    }















}
