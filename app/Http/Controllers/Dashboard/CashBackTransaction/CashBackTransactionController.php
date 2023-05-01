<?php

namespace App\Http\Controllers\Dashboard\CashBackTransaction;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CashBackTransactionController extends Controller
{
    public function index(User $user)
    {
        $user_wallet =  $user->cash_back_wallet;
        return view('dashboard.user-list.cashback-wallet.index', compact('user_wallet', 'user'));
    }

    public function create(User $user, Request $request)
    {
        $request->validate([
            'type' => 'required',
            'product_name' => 'required',
            'amount' => 'required | numeric',
            'message' => 'required',
        ]);

        if($request->type === 'd' && $request->amount > $user->cashbackBlance()) return back()->with(['error' => 'insufficiant amount']);

        $created = $user->cash_back_wallet()->create([
            'product_name' => $request->product_name,
            'type' => $request->type,
            'amount' => $request->amount,
            'message' => $request->message,
        ]);

        if($created) return back()->with(['success', 'successfully added']);
    }
}
