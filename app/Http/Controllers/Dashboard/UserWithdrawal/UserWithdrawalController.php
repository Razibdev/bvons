<?php
namespace App\Http\Controllers\Dashboard\UserWithdrawal;

use App\Exports\WithdrawalExports;
use App\Http\Controllers\Controller;
use App\Model\ShoppingVoucherTransaction;
use App\Model\ShoppingWalletTransaction;
use App\Model\Withdrawal\Withdrawal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class UserWithdrawalController extends Controller
{
    public function allWithdrawal()
    {
        $user_withdrawal = Withdrawal::all();
        return view('dashboard.user-withdrawal.all_request', compact(['user_withdrawal']));
    }

    public function pending()
    {
        $user_withdrawal = Withdrawal::where('status', 'pending')->get();
        return view('dashboard.user-withdrawal.pending', compact(['user_withdrawal']));
    }

    public function accepted()
    {
        $user_withdrawal = Withdrawal::where('status', 'accepted')->get();
        return view('dashboard.user-withdrawal.accepted', compact(['user_withdrawal']));
    }

    public function rejected()
    {
        $user_withdrawal = Withdrawal::where('status', 'rejected')->get();
        return view('dashboard.user-withdrawal.rejected', compact(['user_withdrawal']));
    }

    public function details(Withdrawal $withdrawal)
    {
        return view('dashboard.user-withdrawal.details', compact(['withdrawal']));
    }

    public function accept(Withdrawal $withdrawal)
    {
        if($withdrawal->status === 'accepted') return back()->with(['error' => "This Withdrawal already been accepted"]);
        $withdrawal_accepted = $withdrawal->update([
            'status' => 'accepted'
        ]);
        $amount = ($withdrawal->amount*10)/100;
        $withdrawalAmount = $withdrawal->amount - $amount;

        $userActiveCheck = User::where('id', $withdrawal->user_id)->first();

        if($userActiveCheck->active === 0){
            $withdrawalamount = $withdrawalAmount - 500;
            if($withdrawal_accepted) {
                $withdrawal->user->transactions()->create([
                    "category" => "withdraw",
                    "amount_type" => "d",
                    "amount" => 500,
                    "data" => $withdrawal,
                    "message" => "Withdrawal Accepted and 500 tk for account activation"
                ]);

                $withdrawal->user->transactions()->create([
                    "category" => "withdraw",
                    "amount_type" => "d",
                    "amount" =>  $amount,
                    "data" => $withdrawal,
                    "message" => "Withdrawal Accepted and ".$amount." tk for online service charge"
                ]);

                $withdrawal->user->transactions()->create([
                    "category" => "withdraw",
                    "amount_type" => "d",
                    "amount" =>$withdrawalamount,
                    "data" => $withdrawal,
                    "message" => "Withdrawal Accepted and ".$withdrawalamount." Withdrawal Amount"
                ]);



                User::where('id', $withdrawal->user_id)->update(['active'=> 1, 'activation_date' => date('Y-m-d')]);

                return back()->with(['success' => "Withdrawal has been successfull accpted"]);
            }
        }else{
            if($withdrawal_accepted) {

                $withdrawal->user->transactions()->create([
                    "category" => "withdraw",
                    "amount_type" => "d",
                    "amount" => $amount,
                    "data" => $withdrawal,
                    "message" => "Withdrawal Accepted".$amount." for Online service charge"
                ]);

                $withdrawal->user->transactions()->create([
                    "category" => "withdraw",
                    "amount_type" => "d",
                    "amount" => $withdrawalAmount,
                    "data" => $withdrawal,
                    "message" => "Withdrawal Accepted and ".$withdrawalAmount." for withdrawal amount"
                ]);

                return back()->with(['success' => "Withdrawal has been successfull accpted"]);
            }
        }


        return false;
    }

    public function reject(Withdrawal $withdrawal) {
        $withdrawal_rejected = $withdrawal->update([
            'status' => 'rejected'
        ]);
        if($withdrawal_rejected) {
            return back()->with(['success' => "Withdrawal has been rejected successfully"]);
        }

        return back()->with(['error' => "Some error happend. Please try again latter"]);
    }

    public function paid(Request $request)
    {
        $withdrawal_updated =  Withdrawal::whereIn('id', $request->paidList)->update([ "status" => 'paid']);
        if($withdrawal_updated){
            if($request->singleUpdate) {
                Session::flash('success', 'Withdrawal has been paid successfully');
                return "success";
            }
            return back()->with(['success' => "Withdrawal has been paid successfully"]);
        }
        return back()->with(['error' => "Some error happend. Please try again latter"]);
    }

    public function refund(Request $request)
    {
        if($withdrawal->status === 'refunded') return back()->with(['error' => "This Withdrawal already been refunded"]);

        $withdrawal = Withdrawal::find($request->id);
        $amount = ($withdrawal->amount * 10)/100;
        $refunded = $withdrawal->user->transactions()->create([
            'category' => 'withdrawal_refund',
            'amount_type' => 'c',
            'amount' => $withdrawal->amount + $amount,
            'data' => json_encode($withdrawal->makeHidden('user')),
            'message' => 'Withdrawal Refunded'
        ]);

        if($refunded) {
            if($withdrawal->update(['status' => 'refunded'])) {
                if($request->singleUpdate) {
                    Session::flash('success', 'Withdrawal has been refund successfully');
                    return "success";
                }
                return back()->with(['success' => "Withdrawal has been refund successfully"]);
            }
        }
        return back()->with(['error' => "Some error happend. Please try again latter"]);
    }


    public function export()
    {
        return Excel::download(new WithdrawalExports(), 'withdrawals_accepted_list-'. Carbon::now()->timestamp .'.xlsx');
    }


    public function accountActivation(){

        $users = User::where('active', 1)->orderBy('activation_date', 'desc')->get();
        return view('dashboard.user-withdrawal.account_activation', compact('users'));
    }


    public function shoppingWallet(){
        $users = User::where('type', '!=', 'GU')->paginate(5);
        return view('dashboard.user-withdrawal.shopping_wallet', compact('users'));
    }

    public function  shoppingWalletDetails($id){
        $transactions = ShoppingWalletTransaction::where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
        $user = User::where('id', $id)->first();
        return view('dashboard.user-withdrawal.shopping_wallet_details', compact('transactions', 'id', 'user'));
    }



    public function shoppingVoucher(){
        $users = User::where('type', '!=', 'GU')->paginate(5);
        return view('dashboard.user-withdrawal.shopping_voucher', compact('users'));
    }



    public function shoppingVoucherDetails($id){
        $transactions = ShoppingVoucherTransaction::where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
        $user = User::where('id', $id)->first();
        return view('dashboard.user-withdrawal.shopping_voucher_details', compact('transactions', 'id', 'user'));
    }




    public function shoppingWalletBalance(Request $request){
       if($request->isMethod('post')){
            $data = $request->all();
            $transaction = new ShoppingWalletTransaction();
            $transaction->user_id = $data['id'];
            $transaction->category = "From Admin Transaction";
            $transaction->amount_type = $data['amount_type'];
            $transaction->amount = $data['amount'];
            $transaction->data = '';
            $transaction->message = 'From Admin Transaction';
            $transaction->check_date = date('Y-m-d');
            $transaction->save();
            return redirect()->back();
       }
    }


    public function shoppingVoucherBalance(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $transaction = new ShoppingVoucherTransaction();
            $transaction->user_id = $data['id'];
            $transaction->category = "From Admin Transaction";
            $transaction->amount_type = $data['amount_type'];
            $transaction->amount = $data['amount'];
            $transaction->data = '';
            $transaction->message = 'From Admin Transaction';
            $transaction->check_date = date('Y-m-d');
            $transaction->save();
            return redirect()->back();
        }
    }



}
