<?php

namespace App\Http\Controllers\Dashboard\UserVerification;

use App\Http\Controllers\Controller;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\User\UserVerificationDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Model\User\UserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserVerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    public function allRequest()
    {
        return view('dashboard.user-verification.all_request');
    }
    public function allRequestDatatables()
    {
        $user_verification = DB::table('user_verifications')
            ->select([
                'user_verifications.id',
                'users.name',
                'users.phone',
                'users.referral_id',
                'user_verifications.payment_method',
                'user_verifications.payment_details',
                'user_verifications.transaction_id',
                'user_verifications.status',
                'user_verifications.rejected',
                'user_verifications.created_at',
            ])
            ->join('users', 'user_verifications.user_id', '=', 'users.id')
            ->join('user_verification_details', 'user_verification_details.user_id', '=', 'users.id');

        return Datatables::of($user_verification)
            ->addColumn('payment_info', function ($u_verification) {
                return '
                    <table class="table table-bordered table-dark table-vcenter">
                        <tr>
                            <th>Payment Method</th>
                            <td>'. $u_verification->payment_method .'</td>
                        </tr>
                        <tr>
                            <th>Payment Details</th>
                            <td>'. $u_verification->payment_details .'</td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td>'. $u_verification->transaction_id .'</td>
                        </tr>
                    </table>
                ';
            })
            ->addColumn('created_at', function($u_verification){
                return $u_verification->created_at ? with(new Carbon($u_verification->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($u_verification){
                return '
                <div class="btn-group" role="group">
                                    <a class="btn btn-alt-info text-link" href="'. route('user_verification.bp_request.details', ["user_verification" => $u_verification->id]) .'" target="_blank">
                                        <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                                    </a>
                                </div>
                ';
            })
            ->rawColumns(['payment_info', 'action'])
            ->make(true);

    }
    public function pendingRequest()
    {
        /*$user_verification_pending_request = UserVerification::with(['user' => function ($query) {
            return $query->with('verification_details');
        }])->where('status', 'pending')->latest()->get();*/
        $total_verified_today = UserVerification::totalVerifiedToday();
        return view('dashboard.user-verification.pending', compact(['total_verified_today']));
    }
    public function pendingRequestDatatables()
    {
         $user_verification = DB::table('user_verifications')
            ->select([
                'user_verifications.id',
                'users.name',
                'users.phone',
                'users.referral_id',
                'user_verifications.payment_method',
                'user_verifications.payment_details',
                'user_verifications.transaction_id',
                'user_verifications.status',
                'user_verifications.rejected',
                'user_verifications.created_at',
            ])
            ->join('users', 'user_verifications.user_id', '=', 'users.id')
            ->join('user_verification_details', 'user_verification_details.user_id', '=', 'users.id')
            ->where('user_verifications.status', 'pending');

        return Datatables::of($user_verification)
            ->addColumn('payment_info', function ($u_verification) {
                return '
                    <table class="table table-bordered table-dark table-vcenter">
                        <tr>
                            <th>Payment Method</th>
                            <td>'. $u_verification->payment_method .'</td>
                        </tr>
                        <tr>
                            <th>Payment Details</th>
                            <td>'. $u_verification->payment_details .'</td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td>'. $u_verification->transaction_id .'</td>
                        </tr>
                    </table>
                ';
            })
            ->addColumn('created_at', function($u_verification){
                return $u_verification->created_at ? with(new Carbon($u_verification->created_at))->format('d/m/Y - h:i a') : '';
            })

            ->addColumn('action', function($u_verification){
                return '
                <div class="btn-group" role="group">
                    <a class="btn btn-alt-info text-link" href="'. route('user_verification.bp_request.details', ["user_verification" => $u_verification->id]) .'" target="_blank">
                        <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                    </a>
                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'. ucfirst($u_verification->status) .'</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <form action="'. route('user_verification.bp_request_accept', ["id" => $u_verification->id]) .'" method="post">
                            '. csrf_field() .'
                            '. method_field("patch") .'
                            <button type="submit" class="dropdown-item text-success">
                                <i class="fa fa-check mr-5"></i>Accept
                            </button>
                        </form>
                        <form action="'. route('user_verification.bp_request_reject', ["user_verification" => $u_verification->id]) .'" method="post">
                            '. csrf_field() .'
                            '. method_field("patch") .'
                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm(\'Are you sure want to do this?\')">
                                <i class="fa fa-remove mr-5"></i>Reject
                            </button>
                        </form>
                    </div>
                </div>
                ';
            })
            ->rawColumns(['payment_info', 'action'])
            ->make(true);
    }
    public function acceptRequest()
    {
        return view('dashboard.user-verification.accepted');
    }
    public function acceptedRequestDatatables()
    {
        $user_verification = DB::table('user_verifications')
            ->select([
                'user_verifications.id',
                'users.name',
                'users.phone',
                'users.referral_id',
                'user_verifications.payment_method',
                'user_verifications.verified_date',
                'user_verifications.payment_details',
                'user_verifications.transaction_id',
                'user_verifications.status',
                'user_verifications.rejected',
            ])
            ->join('users', 'user_verifications.user_id', '=', 'users.id')
            ->join('user_verification_details', 'user_verification_details.user_id', '=', 'users.id')
            ->where('user_verifications.status', 'accepted');
        return Datatables::of($user_verification)
            ->addColumn('payment_info', function ($u_verification) {
                return '
                    <table class="table table-bordered table-dark table-vcenter">
                        <tr>
                            <th>Payment Method</th>
                            <td>'. $u_verification->payment_method .'</td>
                        </tr>
                        <tr>
                            <th>Payment Details</th>
                            <td>'. $u_verification->payment_details .'</td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td>'. $u_verification->transaction_id .'</td>
                        </tr>
                    </table>
                ';
            })
            ->addColumn('verified_date', function($u_verification){
                return $u_verification->verified_date ? with(new Carbon($u_verification->verified_date))->format('d/m/Y - h:i a') : '';
            })

            ->addColumn('action', function($u_verification){
                return '
                    <div class="btn-group" role="group">
                        <a class="btn btn-alt-info text-link" href="'. route('user_verification.bp_request.details', ["user_verification" => $u_verification->id]) .'" target="_blank">
                            <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                        </a>
                    </div>
                ';
            })
            ->rawColumns(['payment_info', 'action'])
            ->make(true);

    }
    public function rejectedRequest()
    {
        return view('dashboard.user-verification.rejected');
    }
    public function rejectedRequestDatatables()
    {
        $user_verification = DB::table('user_verifications')
            ->select([
                'user_verifications.id',
                'users.name',
                'users.phone',
                'user_verifications.payment_method',
                'user_verifications.payment_details',
                'user_verifications.transaction_id',
                'user_verifications.status',
                'user_verifications.rejected',
                'user_verifications.updated_at',
            ])
            ->join('users', 'user_verifications.user_id', '=', 'users.id')
            ->join('user_verification_details', 'user_verification_details.user_id', '=', 'users.id')
            ->where('user_verifications.status', 'rejected');
        return Datatables::of($user_verification)
            ->addColumn('payment_info', function ($u_verification) {
                return '
                    <table class="table table-bordered table-dark table-vcenter">
                        <tr>
                            <th>Payment Method</th>
                            <td>'. $u_verification->payment_method .'</td>
                        </tr>
                        <tr>
                            <th>Payment Details</th>
                            <td>'. $u_verification->payment_details .'</td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td>'. $u_verification->transaction_id .'</td>
                        </tr>
                    </table>
                ';
            })
            ->addColumn('updated_at', function($u_verification){
                return $u_verification->updated_at ? with(new Carbon($u_verification->updated_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($u_verification){
                return '
                    <div class="btn-group" role="group">
                        <a class="btn btn-alt-info text-link" href="'. route('user_verification.bp_request.details', ["user_verification" => $u_verification->id]) .'" target="_blank">
                            <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                        </a>
                    </div>
                ';
            })
            ->rawColumns(['payment_info', 'action'])
            ->make(true);

    }
    public function details(UserVerification $user_verification)
    {
        return view('dashboard.user-verification.details', compact('user_verification'));
    }
    // post request for accept and reject
    public function accept(UserVerification $id, Request $request)
    {

//        echo "<pre>"; print_r($id->user->name);die;
        $total_verified_today = UserVerification::totalVerifiedToday();
        $limit = 9999;
        if( $total_verified_today >= $limit ) return back()->withErrors(["verified_overload" => "cannot verified today"]);
        $ref_id = $id->user->makeReferralId();
        $referred_user = User::validateReferralId($request->referred_by);
        $verification_minumum_order_amount = (float) AdminSetting::getSetting('User Verification Minimum Order Amount');
        $has_order_amount = false;
        if($id->user->orders()->count()) {
            foreach ($id->user->orders()->where('order_status', 'complete')->get() as $order) {
                if($order->order_amount >= $verification_minumum_order_amount) {
                    $has_order_amount = true;
                    break;
                };
            }
        }

        if(!$has_order_amount) return back()->with(["error" => "User doesn't have any order or doesn't order than minimum amount"]);

        if($referred_user) {
            $id->status = "accepted";
            $id->verified_date = Carbon::now();
            $user_verification_accepted = $id->save();
            if($user_verification_accepted) {
                $id->user->update([
                    'referred_by' => $request->referred_by,
                    'referral_id' => $ref_id,
                    'type' => 'BP',
                    'verified' => 1
                ]);
                $referred_user->giveSubscriptionBonus($id->user->name);
                return back()->with(['success' => 'user has been successfully verified']);
            }
        }

        return back()->with(["error" => "invalid referred By"]);
    }
    public function reject(UserVerification $user_verification)
    {
        if($user_verification->rejected === 3 && $user_verification->status === "blocked") return response(['error' => "user verification is already blocked cannot be rejected"], 422);

        $rejected = $user_verification->update([
           "rejected" => $user_verification->rejected + 1,
            "status" => "rejected"
        ]);

        if($rejected && $user_verification->rejected === 3) {
            $user_verification->status = 'blocked';
            $user_verification->save();
        }

        return back()->with(['success' => "user has been successfully rejected {$user_verification->rejected} times"]);
    }

    public function modifyVerificationDetails(UserVerificationDetail $user_verification_details, Request $request)
    {
        $updated = $user_verification_details->update($request->all());
        if($updated) return back()->with(["success" => "Verification details has been updated successfully"]);
    }
}
