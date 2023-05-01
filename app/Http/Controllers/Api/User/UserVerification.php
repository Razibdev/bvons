<?php
namespace App\Http\Controllers\Api\User;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait UserVerification {

    protected function validator(array $data)
    {
        return Validator::make($data, [
            "verification_info" => "required | array",
            "education_info" => "required | array",
            "referred_by" => "required",
            "verification_info.payment_method" => "required | string",
            "verification_info.payment_details" => "required | string",
            "verification_info.transaction_id" => "required | string",
        ]);
    }

    public function applyForVerification(Request $request)
    {

        if(auth()->user()->check_user_is_verified()) return response()->json(["error" => "user already verified"], 422);


        if(auth()->user()->verification && auth()->user()->verification->status === 'blocked' && auth()->user()->verification->rejected === 3) return response()->json(["error" => "you are rejected:" . auth()->user()->verification->rejected . " times. you are now " . auth()->user()->verification->status], 422);

        $req = json_decode($request["data"], true);

        $this->validator($req)->validate();

        if(auth()->user()->referred_by === null) {
            if($validReferrer = User::validateReferralId($req['referred_by'])) {

                if($validReferrer->has_job()) {
                    auth()->user()->referred_by = $validReferrer->referral_id;
                    auth()->user()->save();
                } else {
                    return response()->json(["error" => "Referred Introducer is not a job holder of Bvon."], 422);
                }
            } else {
                return response()->json(["error" => "invalid referred_by"], 422);
            }
        }

        $education_info_added = auth()->user()->addVerificationDetails($req["education_info"]);

        $verification_added = auth()->user()->applyVerification($req["verification_info"]);

        return response()->json(["education_added" => $education_info_added, "verification_added" => $verification_added], 200);
    }

    public function getVerification() {
        return response()->json(["verification_info" => auth()->user()->verification, "education_info" => auth()->user()->verification_details]);
    }
}
