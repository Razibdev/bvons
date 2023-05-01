<?php
namespace App\Http\Controllers\Api\User;

use App\Model\PaymentMethod\PaymentMethod;
use App\User;
use Illuminate\Http\Request;


trait UserPaymentMethods {

    // get all transaction
    public function getUserPaymentMethods(Request $request)
    {
        return auth()->user()->payment_methods;
    }

    public function createUserPaymentMethods(Request $request)
    {
        $totalPaymentAddedByUsers = auth()->user()->payment_methods()->get()->count();
        if($totalPaymentAddedByUsers === 5) return response()->json(["error" => "Cannot add more than 5 payment methods"], 422);
        $request->validate([
            'name' => 'required',
            'method' => 'required',
            'details' => 'required'
        ]);

        $payment_method = auth()->user()->payment_methods()->create([
            'name' => $request["name"],
            'method' => $request["method"],
            'details' => $request["details"]
        ]);
        return $payment_method;
    }

    public function updateUserPaymentMethods(Request $request, $payment_method_id)
    {
        $request->validate([
            'name' => 'required',
            'method' => 'required',
            'details' => 'required'
        ]);
        $payment_method_updated = auth()->user()->payment_methods()->where('id', $payment_method_id)->update([
            'name' => $request["name"],
            'method' => $request["method"],
            'details' => $request["details"]
        ]);
        if($payment_method_updated) return auth()->user()->payment_methods()->where('id', $payment_method_id)->first();
        return response()->json(["error" => "invalid update"], 422);
    }

}
