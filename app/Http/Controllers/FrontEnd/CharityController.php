<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Model\Charity;
use App\Model\CharityTransaction;
use App\Model\Transaction\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CharityController extends Controller
{
    public function getevent(){
        $events = Charity::orderBy('id', 'desc')->with('donor')->get();
//        $events = json_decode(json_encode($events));
//        echo "<pre>"; print_r($events); die;
        return view('charity.charity', compact('events'));
    }


    public function charityPayment(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $user = User::where('id', Auth::id())->first();
            if(Hash::check($request->password, $user->password)){
                if(Auth::user()->balance() > $data['amount']){
                    $payment = new CharityTransaction();
                    $payment->charity_id = $data['event_id'];
                    $payment->user_id = Auth::id();
                    $payment->category = "event_payment";
                    $payment->amount_type = 'c';
                    $payment->amount = $data['amount'];
                    $payment->message = 'Charity Fund';
                    $payment->save();

                    Transaction::where('user_id',Auth::id())->create([
                        'user_id' => Auth::id(),
                        'category' => 'charity_fund',
                        'amount_type' => 'd',
                        'amount' => $data['amount'],
                        'data' => '',
                        'message' => 'Charity Fund Charge',
                        'check_date' => date('Y-m-d')
                    ]);
                    return redirect()->back();
                }else{
                    Toastr::error('Insaficient Balance');
                    return redirect()->back();
                }
            }else{
                Toastr::error('Password Not Match');
                return redirect()->back();
            }
        }
    }


    public function subAdmin()
    {
        $charities = Charity::all();
        $events =array();
        foreach ($charities as $charity) {
            $sub_admin_id = explode(",", $charity->sub_admin_id);

            for ($i = 0; $i < count($sub_admin_id); $i++) {
                if ($sub_admin_id[$i] == Auth::id()) {
                    $events[] = Charity::where('sub_admin_id', $charity->sub_admin_id)->get();
                } else {
                    continue;
                }
            }
            }

//        $events = json_decode(json_encode($events), true);
//        echo "<pre>"; print_r($events); die;
            return view('charity.subadmin.sub_admin', compact('events'));
        }



        public function transaction($id){
            $transactions = CharityTransaction::where('charity_id', $id)->with('user', 'event')->get();
//            $transactions = json_decode(json_encode($transactions));
//            echo "<pre>"; print_r($transactions); die;
            return view('charity.subadmin.transaction_history', compact('transactions'));
        }












}
