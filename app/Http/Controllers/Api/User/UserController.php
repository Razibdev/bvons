<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Model\Ecommerce\Api\EcoAddress;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use UserFollow, UserProfile, UserTimeline, UserVerification, UserTransaction, UserPaymentMethods, UserWithdrawal;

    public function search(Request $request) {

        $q = $request->query('q');

        if(!$q) return response()->json([]);

        if(strlen($q) == 11 && is_numeric($q)) return User::wherePhone($q)->paginate(10);

        return User::where('name', 'like', '%' . $q . '%')->paginate(10);
    }
    public function getBalance()
    {
        return response()->json([
            "balance" => auth()->user()->balance(),
            "pending_withdrawal" => auth()->user()->pendingBalance(),
            "pending_order_payment_request_amount" => auth()->user()->eWalletPendingAmountInOrdersPayment(),
        ]);
    }
    public function random()
    {
        $totalUser = User::all()->count();

        if($totalUser < 20) {
            return User::where('id', '!=', auth()->user()->id)->get()->random($totalUser - 1);
        }

        return User::where('id', '!=', auth()->user()->id)->get()->random(20);
    }
    public function getCashBackTransaction()
    {
        return auth()->user()->cash_back_wallet()->latest()->get();
    }
    public function getCashBackBalance()
    {
        return response()->json([
            "cash_back_balance" => auth()->user()->cashbackBlance(),
            "cash_back_balance_pending" => auth()->user()->cashbackPendingBlance(),
        ]);
    }
    public function getCashBackPendingBalance()
    {
        return auth()->user()->cashbackPendingBlance();
    }
    public function getAddress()
    {
        return auth()->user()->addresses;
    }
    public function createAddress(Request $request)
    {
        if(auth()->user()->addresses->count() >= 5) return response()->json(["error" => "Cannot add address more than 5"], 422);
        $request->validate([
           'phone' => 'required',
           'address' => 'required',
        ]);

        return auth()->user()->addresses()->create($request->all());
    }
    public function updateAddress($id, Request $request)
    {
        return EcoAddress::where('id', $id)->where('user_id', auth()->id())->update($request->all()) ?? false;

    }
    public function deleteAddress($id)
    {
        $delete = EcoAddress::where('id', $id)->where('user_id', auth()->id())->delete();

        if($delete) {
            return true;
        } else {
            return false;
        }
    }
    public function getPremiumUser(Request $request)
    {
        $user_id = $request->query('user_id');
        $job_type = $request->query('job_type') !== "null" ? $request->query('job_type') : null;

        $user_refferal_id = User::find($user_id)->referral_id ?? "not refferal_id";

        $premium_user = User::where('referred_by', $user_refferal_id)->get();

        $premium_user = $premium_user->filter(function($user) use ($job_type) {
            return $user->check_user_is_verified();
        });

        if($premium_user->count() > 0 && $job_type) {
            $premium_user = $premium_user->filter(function($user) use ($job_type) {
                return $user->has_job() && $user->job->job_type->name === $job_type;
            });
        } else {
            $premium_user = $premium_user->filter(function($user) use ($job_type) {
                return !$user->has_job();
            });
        }
        $data = [
            "main_data" => [],
            "area" => []
        ];


        if($premium_user->count() > 0) {
            foreach ($premium_user as $u) {
                $data["main_data"][] = [
                    "id" => $u->id,
                    "text" => $u->name,
                ];
            }
        }

        if($request->area == "districts") {
            $data["area"] = User::find($user_id)->has_job() ? User::find($user_id)->job->areaable ? User::find($user_id)->job->areaable->districts : null : null;
        } else if($request->area == "thana") {
            $data["area"] = User::find($user_id)->has_job() ? User::find($user_id)->job->areaable ? User::find($user_id)->job->areaable->thanas : null : null;
        } else if($request->area == "village") {
            $data["area"] = User::find($user_id)->has_job() ? User::find($user_id)->job->areaable ? User::find($user_id)->job->areaable->villages : null : null;
        } else {
            $data["area"] = [];
        }
        return $data;
    }

}
