<?php

namespace App\Http\Controllers\Bcourier\Api;

use App\Http\Controllers\Controller;


use App\Model\Bcourier\BcoDeliveryBoy;
use App\Model\Bcourier\BcoPercel;
use App\Model\Bcourier\BcoRequest;
use App\Rules\ValidDeliveryBoy;
use Illuminate\Http\Request;


class BcoRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request)
    {
        $request->validate([
            'bco_percel_id'       => 'required|integer',
            'offer_price'         => 'required|numeric',
        ]);

        if(auth()->user()->is_delivery_boy()) {
            $delivery_boy_id = auth()->user()->delivery_boy->id;
        } else {
            return response()->json(["errors"=>["invalid_delivery_boy" => "User is not a valid delivery boy"]], 422);
        }

        $percel = BcoPercel::where('id', $request->bco_percel_id)->where('status', 'waiting');

        if($percel->count() > 0) {
            if($percel->first()->user_id === auth()->id())
                return response()->json(["errors"=>["invalid_user" => "User cannot request for his/her own Parcel"]], 422);
            if($this->checkRequestGivenByDeliveryBoy($delivery_boy_id, $percel->first()->id))
                return response()->json(["errors"=>["duplicate_request_for_same_parcel" => "You already request for this parcel"]], 422);
        } else {
            return response()->json(["errors"=>["parcel_id" => "invalid percel id"]], 422);
        }

        return BcoRequest::create([
            'bco_delivery_boy_id' => $delivery_boy_id,
            'bco_percel_id' => $percel->first()->id,
            'offer_price' => $request->offer_price,
        ]);

    }


    protected function checkRequestGivenByDeliveryBoy($delivery_id, $percel_id) {
        $request = BcoRequest::where('bco_delivery_boy_id', $delivery_id)->where('bco_percel_id', $percel_id);
        if($request->count() > 0) return $request->first();
        return false;
    }


}
