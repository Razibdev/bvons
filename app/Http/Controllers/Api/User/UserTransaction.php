<?php
namespace App\Http\Controllers\Api\User;

use App\User;
use Illuminate\Http\Request;


trait UserTransaction {

    // get all transaction
    public function getTransaction(Request $request)
    {
        $q = $request->query('limit');
        if($q) return auth()->user()->transactions()->limit($q)->latest()->get(['id', 'user_id', 'category', 'amount_type', 'amount', 'message', 'created_at']);

        return auth()->user()->transactions()->latest()->get(['id', 'user_id', 'category', 'amount_type', 'amount', 'message', 'created_at']);
    }

}
