<?php

namespace App;

use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\DistrictOfficer;
use App\Model\Ecommerce\Api\EcoAddress;
use App\Model\Ecommerce\Api\EcoOrderDetail;
use App\Model\Ecommerce\EcoPayment;
use App\Model\FieldOfficer;
use App\Model\Like;
use App\Model\Matrix;
use App\Model\UpazillaOfficer;
use App\Model\User\UserVerification;
use App\Model\User\UserVerificationDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Exception;
use Qirolab\Laravel\Reactions\Traits\Reacts;
use Qirolab\Laravel\Reactions\Contracts\ReactsInterface;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Multicaret\Acquaintances\Traits\CanBeFollowed;
use Multicaret\Acquaintances\Traits\CanFollow;
use Multicaret\Acquaintances\Traits\CanLike;
use Multicaret\Acquaintances\Traits\Friendable;

class User extends Authenticatable implements JWTSubject, ReactsInterface
{

    use Notifiable, UserRelationship, HasRoles, Reacts;
    use Friendable, CanLike, CanFollow, CanBeFollowed;

    protected $guarded = ['id'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ["is_followed", "storage_url", "has_job"];

    public function getHasJobAttribute()
    {
        return (int) $this->has_job();
    }

    public function matrices(){
        return $this->hasOne(Matrix::class, 'user_id');

    }


    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function getIsFollowedAttribute()
    {
        if(\request()->path() == "api/register") {return false;}
        if(Auth::guard('admin')->check()) {return false;}
        if(Auth::guard('vendor')->check()) {return false;}

        return auth()->user() === null ? null : auth()->user()->isFollowing($this);
    }
    public function getStorageUrlAttribute()
    {
        return $this->mediaUrl();
    }
    public function mediaUrl()
    {
        return [
            "profile_storage" => Storage::disk('user_profile')->url('/'),
            "cover_storage" => Storage::disk('user_cover')->url('/'),
        ];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public static function validateReferralId($referral_id) {
        $user = static::where("referral_id", "!=", null)
            ->where('referral_id', '=', $referral_id)
            ->where('type', "!=", "GU")
            ->first();
        if($user) return $user;

        return false;
    }

    public static function validateDeReferralId($referral_id) {
        $user = static::where("dealer_referral_id", "!=", null)
            ->where('dealer_referral_id', '=', $referral_id)
            ->where('type', "!=", "GU")
            ->first();
        if($user) return $user;

        return false;
    }

    public function giveSubscriptionBonus($name) {
        $subscription_bonus_string = AdminSetting::getSetting('User Subscription Bonus');
        $subscription_bonus_array = explode(",", $subscription_bonus_string);
        static $level = 0;
        $limit = count($subscription_bonus_array);
        $level_bonus = $subscription_bonus_array;
        if( $level >= $limit ) return "end";
        $this->transactions()->create([
            "category" => "subscription_bonus",
            "amount_type" => "c",
            "amount" => $level_bonus[$level],
            "data" => "",
            "message" => ucfirst("you get Subscription Bonus from ".$name." level " . ($level + 1))
        ]);

        $level++;
        if($referral_found = self::validateReferralId($this->referred_by)) $referral_found->giveSubscriptionBonus();
    }



    public function giveBpPackageBonus() {
        $subscription_bonus_string = AdminSetting::getSetting('User Package Bonus');
        $subscription_bonus_array = explode(",", $subscription_bonus_string);
        static $level = 0;
        $limit = count($subscription_bonus_array);
        $level_bonus = $subscription_bonus_array;
        if( $level >= $limit ) return "end";
        $this->transactions()->create([
            "category" => "bp_package_bonus",
            "amount_type" => "c",
            "amount" => $level_bonus[$level],
            "data" => "",
            "message" => ucfirst("you get Package Bonus from  level " . ($level + 1))
        ]);

        $level++;
        if($referral_found = self::validateReferralId($this->referred_by)) $referral_found->giveBpPackageBonus();
    }


    public function giveBpSignUpBonus() {
        $subscription_bonus_string = AdminSetting::getSetting('Daily Free Sign Up Bonus');
        $subscription_bonus_array = explode(",", $subscription_bonus_string);
        static $level = 0;
        $limit = count($subscription_bonus_array);
        $level_bonus = $subscription_bonus_array;
        if( $level >= $limit ) return "end";
        $this->transactions()->create([
            "category" => "bp_signup_bonus",
            "amount_type" => "c",
            "amount" => $level_bonus[$level],
            "data" => "",
            "check_date" => date('y-m-d'),
            "message" => ucfirst("you get BP sign up bonus " . ($level + 1))
        ]);

        $level++;
        if($referral_found = self::validateReferralId($this->referred_by)) $referral_found->giveBpSignUpBonus();
    }








    public function check_user_is_verified()
    {
        return (
            $this->verified === 1 &&
            $this->verification !== null &&
            $this->verification->status === "accepted" &&
            $this->verification_details()->count() > 0
        );

    }
    public function applyVerification($request) {
        return $this->verification()->updateOrCreate(
            ["user_id" => auth()->id()],
            [
                "payment_method" => $request["payment_method"],
                "payment_details" => $request["payment_details"],
                "transaction_id" => $request["transaction_id"],
                "logistics_address" => $request["logistics_address"],
                "t_shirt_size" => $request["t_shirt_size"],
                "status" => "pending"
            ]
        );
    }
    public function addVerificationDetails($educationDetails)
    {
        $updated = [];
        for ($i = 0; $i < count($educationDetails); $i++) {
            $updated[$i] = $this->verification_details()->updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "education" => $educationDetails[$i]["education"]
                ],
                [
                    "email"     => $educationDetails[$i]["email"],
                    "education" => $educationDetails[$i]["education"],
                    "board"     => $educationDetails[$i]["board"],
                    "roll"      => $educationDetails[$i]["roll"],
                    "reg_num"   => $educationDetails[$i]["reg_num"],
                    "group"     => $educationDetails[$i]["group"],
                    "year"      => $educationDetails[$i]["year"]
                ]
            );
        }
        return $updated;

    }
    public function postWithUser() {
        return $this->posts()->with(['user' => function($query){
            return $query->select('id', 'name', 'phone', 'profile_pic', 'verified', 'created_at', 'updated_at');
        }]);
    }
    public function makeReferralId()
    {
        try {
            $total_verified_today = (int) UserVerification::totalVerifiedToday();
            $limit = 9999 + 1;
            if($total_verified_today >= ($limit - 1)) throw new Exception("Total Verified User Overload For Today: Cannot make referral id");
            $serial = Str::substr((string)($limit + $total_verified_today + 1), 1);
            $now = Carbon::now();
            $referral_id = $now->format('dmY') . "{$serial}";
            return $referral_id;

        } catch (\Exception $e) {
            return $e;
        }
    }


    public function makeReferralIdF()
    {
        try {
            $total_verified_today = User::where('type', '!=', 'GU')->whereDate('updated_at', Carbon::today())->count();
            $limit = 9999 + 1;
            if($total_verified_today >= ($limit - 1)) throw new Exception("Total Verified User Overload For Today: Cannot make referral id");
            $serial = Str::substr((string)($limit + $total_verified_today + 1), 1);
            $now = Carbon::now();
            $referral_id = $now->format('dmY') . "{$serial}";
            return $referral_id;

        } catch (\Exception $e) {
            return $e;
        }
    }




    public function balance() {
        $credit = $this->transactions()->where('amount_type', 'c')->pluck('amount')->sum();
        $debit = $this->transactions()->where('amount_type', 'd')->pluck('amount')->sum();
        return (double) ($credit - $debit);
    }

    public function shoppingVoucherBalance(){
        $credit = $this->shoppingVoucherTransactions()->where('amount_type', 'c')->pluck('amount')->sum();
        $debit = $this->shoppingVoucherTransactions()->where('amount_type', 'd')->pluck('amount')->sum();
        return (double) ($credit - $debit);
    }

    public function shoppingWalletBalance(){
        $credit = $this->shoppingWalletTransactions()->where('amount_type', 'c')->pluck('amount')->sum();
        $debit = $this->shoppingWalletTransactions()->where('amount_type', 'd')->pluck('amount')->sum();
        return (double) ($credit - $debit);
    }

    public function merchantBalance(){
        $credit = $this->merchantTransaction()->where('amount_type', 'c')->pluck('amount')->sum();
        $debit = $this->merchantTransaction()->where('amount_type', 'd')->pluck('amount')->sum();
        return (double) ($credit - $debit);
    }







    public function pendingBalance()
    {
        $pending_balance = $this->withdrawals()->where('status', 'pending')->pluck('amount')->sum();
        return (double) $pending_balance;
    }
    public function payment_method($payment_id)
    {
        return $this->payment_methods->where('id', $payment_id)->first();
    }
    public function referred_user()
    {
        $referred_user = static::whereNotNull('referral_id')->where('referral_id', $this->referred_by)->first();
        if($referred_user) {
            return $referred_user;
        } else {
            return null;
        }

    }


    public function getChildUser()
    {
        $referred_user = static::whereNotNull('referred_by')->where('referred_by', $this->referral_id);
        return $referred_user->count() ?  $referred_user->paginate(10) : [];
    }
    public function cashbackBlance()
    {
        $c = $this->cash_back_wallet()->where('type', 'c')->pluck('amount')->sum();
        $d = $this->cash_back_wallet()->where('type', 'd')->pluck('amount')->sum();
        return $c - $d;
    }
    public function cashbackPendingBlance()
    {
        $order_list = $this->orders()
            ->where('order_status', '!=', 'complete')
            ->where('order_status', '!=', 'cancel');


        if($order_list->count() > 0) {
            $orders_id = $order_list->get()->pluck('id');
            return (double) EcoPayment::whereIn('order_id', $orders_id)->where("order_type", "Cashback")->sum('amount');
        }
        return 0;
    }
    public function eWalletPendingAmountInOrdersPayment()
    {
        $order_list = $this->orders()->where('order_status', '=', 'pending')->where('payment_status', '=', 'pending');
        if($order_list->count() > 0) {
            $orders_id = $order_list->get()->pluck('id');
            return (double) EcoPayment::whereIn('order_id', $orders_id)->where("order_type", "E-wallet")->sum('amount');
        }
        return 0;
    }
    public function hasEwaletPendingRequestInOrdersPayment()
    {
        if($this->eWalletPendingAmountInOrdersPayment() > 0) {
            return true;
        }
        return false;
    }
    public function hasEwaletPendingWithdrawal()
    {
        return $this->withdrawals()->where('status', 'pending')->get()->count() > 0;
    }
    public function is_delivery_boy()
    {
        return $this->delivery_boy()->count() === 1 && $this->delivery_boy->status === 'active';
    }
    public function is_delivery_boy_banned()
    {
        return $this->delivery_boy()->count() === 1 && $this->delivery_boy->status === 'banned';
    }
    public function has_job()
    {
        return $this->job()->count() === 1 ? true : false;
    }

    public function matrix(){
        return $this->hasOne(Matrix::class, 'user_id');
    }

    public  function disofficer(){
        return $this->hasOne(DistrictOfficer::class, 'user_id');
    }


    public  function upaofficer(){
        return $this->hasOne(UpazillaOfficer::class, 'user_id');
    }

    public  function fieldofficer(){
        return $this->hasOne(FieldOfficer::class, 'user_id');
    }




}
