<?php
namespace App\Http\Controllers\Api\User;
use App\User;
use Illuminate\Http\Request;


trait UserWithdrawal {
    public function applyForWithdrawal(Request $request)
    {
        $request->validate([
            "amount" => "required | numeric",
            "payment_method_id" => "required",
        ]);
        if(!auth()->user()->check_user_is_verified()) return response()->json(["error" => "User is not verified"], 422);
        $withdrawal_limit = 300;
        $user_balance = auth()->user()->balance();
        if($request->amount < $withdrawal_limit) return response()->json(["error" => "Minimum withdrawal amount {$withdrawal_limit} tk"], 422);
        if($request->amount > $user_balance) return response()->json(["error" => "Insufficient balance"], 422 );
        if(auth()->user()->hasEwaletPendingWithdrawal() || auth()->user()->hasEwaletPendingRequestInOrdersPayment()) return response()->json(['error' => 'Already have pending request'], 422);
        return auth()->user()->withdrawals()->create([
            "amount" => $request->amount,
            "status" => "pending",
            "payment_method_id" => $request->payment_method_id
        ]);

        // notify admin that a user requset for withdrawal

    }

}
