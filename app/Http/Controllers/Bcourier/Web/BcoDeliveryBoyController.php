<?php

namespace App\Http\Controllers\Bcourier\Web;

use App\Http\Controllers\Controller;
use App\Model\Bcourier\BcoDeliveryBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BcoDeliveryBoyController extends Controller
{
    protected function activeDeliveryBoy($delivery_boy) {
        if($delivery_boy->status === "active") return ["message" => ["error" => "Delivery Boy already active"]];
        if($delivery_boy->update(["status" => 'active'])) return ["message" => ["success" => "Delivery Boy has been active successfully"]];
        return ["message" => ["error" => "Delivery cannot be activted right now. Please try later"]];
    }

    protected function cancelDeliveryBoy($delivery_boy) {
        if($delivery_boy->status === "cancel") return ["message" => ["error" => "Delivery Boy already cancel"]];
        if($delivery_boy->update(["status" => 'cancel'])) return ["message" => ["success" => "Delivery Boy has been active successfully"]];
        return ["message" => ["error" => "Delivery cannot be canceled right now. Please try later"]];
    }

    protected function bannedDeliveryBoy($delivery_boy) {
        if($delivery_boy->status === "banned") return ["message" => ["error" => "Delivery Boy already banned"]];
        if($delivery_boy->update(["status" => 'banned'])) return ["message" => ["success" => "Delivery Boy has been active successfully"]];
        return ["message" => ["error" => "Delivery cannot be banned right now. Please try later"]];
    }

    public function __construct()
    {

        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('bcourier.delivery-boy.index');
    }
    public function indexDatatables()
    {
        $delivery_boy = BcoDeliveryBoy::get(['bco_delivery_boys.*', DB::raw('@rownum  := @rownum  + 1 AS rownum')]);

        return Datatables::of($delivery_boy)
            ->addColumn('pic', function($deli_boy){
                return '<img src="'. Storage::disk('user_upload')->url($deli_boy->pic) .'" style="width: 50px; height: 50px;"/>';
            })
            ->addColumn('username', function($deli_boy){
                return $deli_boy->user->name;
            })
            ->addColumn('action', function($deli_boy){
                return '
                <div class="btn-group" role="group">
                    <a class="btn btn-alt-info text-link cu-popover" data-content="View Details" href="'. route('bco.delivery_boy.show', ['delivery_boy' => $deli_boy->id]) .'" target="_blank">
                        <i class="fa fa-fw fa-info-circle mr-5"></i>
                    </a>
                </div>
                ';
            })
            ->rawColumns(['action', 'pic'])
            ->make(true);
    }
    public function show(BcoDeliveryBoy $delivery_boy)
    {
        return view('bcourier.delivery-boy.show', compact('delivery_boy'));
    }
    public function changeStatus(BcoDeliveryBoy $delivery_boy, Request $request)
    {
        $status = $request->query('status') ?? null;
        if(!$status) return back()->with(['error' => 'invalid status']);

        if($status === 'active') {
            $change_status = $this->activeDeliveryBoy($delivery_boy);
            return back()->with($change_status["message"]);
        } else if($status === 'cancel') {
            $change_status = $this->cancelDeliveryBoy($delivery_boy);
            return back()->with($change_status["message"]);
        } else if($status === 'banned') {
            $change_status = $this->bannedDeliveryBoy($delivery_boy);
            return back()->with($change_status["message"]);
        }
    }

}
