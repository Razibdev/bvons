<?php
namespace App\Http\Controllers\Api\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Upload;

trait UserProfile {
//    get user profile

    public function getProfile($user_id = null)
    {
        if($user_id === null) return auth()->user();

        $user = User::find($user_id);

        if($user) return $user;

        return response()->json(["error" => "invalid user id"], 422);

    }

//    update user profile
    public function updateProfile(Request $request)
    {
        $q = $request->query("update");
        if(!$q) return response()->json(["error" => "invalid query key"], 422);

        $denyUpdateField = [
            'phone',
            'uuid',
            'fuuid',
            'verified',
            'balance',
            'type',
            'email_verified_at',
            'created_at',
            'updated_at'
        ];
        $userCollection = collect(auth()->user());
        if(in_array($q, $denyUpdateField)) return response()->json(["error" => "permission deny cannot update this field"], 422);


        if(!$userCollection->has($q)) return response()->json(["error" => "query value is not valid"], 422);

        $request->validate([
           "value" => ['required'],
        ]);

        if($q === 'cover_pic' || $q === 'profile_pic') {
            if($q === 'profile_pic') {
                Storage::disk('user_profile')->delete( auth()->id() . '/' . auth()->user()->profile_pic);
                auth()->user()->$q = Upload::storeMediaFromBase64($request->value, 'user_profile', "/" . auth()->id())[0];
            } else {
                Storage::disk('user_cover')->delete( auth()->id() . '/' . auth()->user()->cover_pic);
                auth()->user()->$q = Upload::storeMediaFromBase64($request->value, 'user_cover', "/" . auth()->id())[0];
            }

        } else {
            auth()->user()->$q = $request->value;
        }

        $success = auth()->user()->save();

        if($success) return [
            "success"   => true,
            "data"      => $q === 'cover_pic' || $q === 'profile_pic'  ? auth()->user()->only($q, "storage_url") : auth()->user()->only($q),
            "message"   => "$q has been change to " . auth()->user()->$q
        ];
    }
}
