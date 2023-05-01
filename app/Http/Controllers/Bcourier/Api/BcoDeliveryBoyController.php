<?php

namespace App\Http\Controllers\Bcourier\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bcourier\DeliveryBoyCollection;
use App\Model\Bcourier\BcoDeliveryBoy;
use Illuminate\Http\Request;

class BcoDeliveryBoyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        return auth()->user()->is_delivery_boy() ?  new DeliveryBoyCollection(auth()->user()->delivery_boy) : null;
    }
    public function register(Request $request)
    {
        if(!auth()->user()->check_user_is_verified()) return response()->json(["error" => "user is not a premium user"], 433);
        if(auth()->user()->is_delivery_boy()) return response()->json(["error" => "This user already an delivery boy"], 433);
        if(auth()->user()->is_delivery_boy_banned()) return response()->json(["error" => "You are blocked from this service"], 433);


        // validate request
        $request->validate([
            'pic'                   => 'required|mimes:jpg,jpeg,png',
            'nid_pic'               => 'required|mimes:jpg,jpeg,png',
            'p_nid_pic'             => 'required|mimes:jpg,jpeg,png',
            'e_bill_pic'            => 'required|mimes:jpg,jpeg,png',
            'present_address'       => 'required',
            'permanent_address'     => 'required',
        ]);

        // return the created delivery_boy
        return auth()->user()->delivery_boy()->updateOrCreate([
            'pic'                   => $request->file('pic')->storeAs(auth()->id() .'/delivery_boy',"pic.{$request->file('pic')->extension()}", 'user_upload'),
            'nid_pic'               => $request->file('nid_pic')->storeAs(auth()->id() .'/delivery_boy',"nid_pic.{$request->file('nid_pic')->extension()}", 'user_upload'),
            'p_nid_pic'             => $request->file('p_nid_pic')->storeAs(auth()->id() .'/delivery_boy',"p_nid_pic.{$request->file('p_nid_pic')->extension()}", 'user_upload'),
            'e_bill_pic'            => $request->file('e_bill_pic')->storeAs(auth()->id() .'/delivery_boy',"e_bill_pic.{$request->file('e_bill_pic')->extension()}", 'user_upload'),
            'present_address'       => $request->present_address,
            'permanent_address'     => $request->permanent_address,
            'status'                => "pending",
        ]);
    }
    public function status()
    {
        return auth()->user()->delivery_boy()->count() === 1
            ? response()->json([
                "id" => auth()->user()->delivery_boy->id,
                "status" => auth()->user()->delivery_boy->status,
                ], 200) : null;
    }

    public function parcel()
    {
        if(!auth()->user()->is_delivery_boy()) return response()->json(["errors" => ["delivery_boy" => "invalid delivery boy"]]);

        return BcoDeliveryBoy::get_percel();
    }
}
