<?php
namespace App\Http\Controllers\Api\Auth;
use Upload;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
trait RegisterUser {
    public function register(Request $request) {
        $fuuid_found = $this->getFirebaseUUid($request->fuuid);
        if(!$fuuid_found) return response()->json(['error' => 'invalid fuuid'], 422);
        $request->validate([
            'phone' => ['required', 'max:11', 'unique:users'],
            'name' => ['required', 'max:30', 'min:3'],
            'fuuid' => ['required', 'unique:users'],
            'device_id' => ['required', 'unique:users'],
            'profile_pic' => ['required'],
            'password' => ['required'],
        ]);
        if( !$request->has('referral_id') ) return response()->json(['error' => 'please pass an referral id in body'], 422);

        // there is no referral id insert general user without any referral bonus system
        if($request->referral_id === null || $request->referral_id === "") {
            //1. register the user or create new user
            $user = $this->createUser($request);
            //2. notify the newly created user that your account has been created
            //3. notify the admin that a new general user has been created without any bp
            return response()->json($user);
        }

        $validReferralUser = User::validateReferralId($request->referral_id);

        if(!$validReferralUser) return response()->json(['error' => 'invalid referral id'], 422);

        //1. register the user or create new user with referral id
        $user = $this->createUser($request, $validReferralUser->has_job() ? $validReferralUser->referral_id : null);

        //2. notify the newly created user that your account has been created
        //3. notify the admin that a new general user has been created with this BP
        //4. notify the referer or bp that you just created new user

        /*
            this is for registration bonus uncomment for
            $this->giveReferralBonus($validReferralUser);
        */

        return $user;
    }

    // get firebase user with fuuid
    protected function getFirebaseUUid($fuuid) {
        $factory = (new Factory)->withServiceAccount(Storage::disk('db')->path('firebase/firebase_credentials.json'));
        $auth = $factory->createAuth();
        try {
            $user = $auth->getUser($fuuid);
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return false;
        }

        return $user;
    }

    protected function createUser($request, $referral_id = null) {
        $user = User::create([
            "phone" => $request->phone,
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "uuid" => \Str::uuid(),
            "fuuid" => $request->fuuid,
            "referred_by" => $referral_id,
            "device_id" => $request->device_id
        ]);

        $user->profile_pic = Upload::storeMediaFromBase64($request->profile_pic, 'user_profile', "/{$user->id}")[0];
        $user->cover_pic = Upload::storeMediaFromBase64($request->cover_pic, 'user_cover', "/{$user->id}")[0];
        $user->save();
        return $user;
    }

    protected function giveReferralBonus($referral_user) {
        static $level = 0;
        $limit = 2;
        $registration_bonus_setting = AdminSetting::getSetting('User Registration Bonus');

        $registration_bonus = array_map('floatval', explode(',', $registration_bonus_setting));

        if($level > $limit) return;

        switch ($level) {
            case 0:
                if($referral_user->type === "GU" || $referral_user->referral_id === NULL) throw new \Exception("General User Trying to Get BP Bonus");

                if($referral_user->type === "BP" || $referral_user->type === "AS" || $referral_user->type === "MM") {
                    //1. transaction -> credit ->  give the referer or BP 10 taka bonus
                    $referral_user->transactions()->create([
                        "category" => "bp_reg_referral_bonus",
                        "amount_type" => "c",
                        "amount" => $registration_bonus[$level],
                        "data" => json_encode($referral_user),
                        "message" => ucfirst("you get registration bonus level {$level}")
                    ]);
                    //2. notify the referer or bp that you got 10 taka bonus
                    //3. also notify the admin that this bp get 10 taka bonus (BP Bonus)

                    $myReferrer = User::validateReferralId($referral_user->referred_by);

                    $level++;
                    if(!$myReferrer) return;
                    $this->giveReferralBonus($myReferrer);
                }
                break;
            case 1:
                if($referral_user->type === "GU" || $referral_user->referral_id === NULL) throw new \Exception("General User Trying to Get Area Supervisor Bonus");

                if($referral_user->type === "BP") return;

                //1. transaction -> credit ->  give the referer or AS or MM 5 taka bonus
                if($referral_user->type === "AS" || $referral_user->type === "MM") {
                    $referral_user->transactions()->create([
                        "category" => "as_reg_referral_bonus",
                        "amount_type" => "c",
                        "amount" => $registration_bonus[$level],
                        "data" => json_encode($referral_user),
                        "message" => ucfirst("you get registration bonus level {$level}")
                    ]);
                    //2. notify the referer or bp that you got 10 taka bonus
                    //3. also notify the admin that this bp get 10 taka bonus (BP Bonus)


                    $myReferrer = User::validateReferralId($referral_user->referred_by);
                    $level++;
                    if(!$myReferrer) return;

                    $this->giveReferralBonus($myReferrer);
                }
                break;
            case 2:
                if($referral_user->type === "GU" || $referral_user->referral_id === NULL) throw new \Exception("General User Trying to Get Area Supervisor Bonus");

                if($referral_user->type === "BP" || $referral_user->type === "AS" ) return;

                //1. transaction -> credit ->  give the referer or AS or MM 5 taka bonus
                if($referral_user->type === "MM") {
                    $referral_user->transactions()->create([
                        "category" => "mm_reg_referral_bonus",
                        "amount_type" => "c",
                        "amount" => $registration_bonus[$level],
                        "data" => json_encode($referral_user),
                        "message" => ucfirst("you get registration bonus level {$level}")
                    ]);
                    //2. notify the referer or bp that you got 10 taka bonus
                    //3. also notify the admin that this bp get 10 taka bonus (BP Bonus)
                    $level++;
                }
                break;
            default:
                return;
        }

    }
}
