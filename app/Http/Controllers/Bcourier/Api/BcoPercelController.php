<?php

namespace App\Http\Controllers\Bcourier\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bcourier\BcoPercelCollection;
use App\KuHelpers\Helpers;
use App\Model\Bcourier\BcoPercel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BcoPercelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $status = $request->query('status') ?? null;
        $tracking_number = $request->query('tracking_number') ?? null;
        $percel = auth()->user()->percel();

        if($tracking_number) $percel = $percel->where('tracking_number','LIKE', "%$tracking_number%");
        if($status) $percel = $percel->where('status', $status);

        return BcoPercelCollection::collection($percel->orderBy('created_at', 'desc')->paginate(10));
    }
    public function create(Request $request)
    {
        $request->validate([
            'bco_percel_type_id'    => "required|integer",
            'name'                  => 'required',
            'weight'                => 'required|numeric',
            'images.*'              => 'required',
            'sender_name'           => 'required',
            'sender_phone'          => 'required',
            'offer_price'           => 'required|numeric',
            'pickup_address'        => 'required',
            'pickup_geo_location'   => 'required',
            'receiver_name'         => 'required',
            'receiver_phone'        => 'required',
            'receiver_address'      => 'required',
            'receiver_geo_location' => 'required',
        ]);

        $percel = auth()->user()->percel()->create([
           'bco_percel_type_id'     => $request->bco_percel_type_id,
           'name'                   => $request->name,
           'weight'                 => $request->weight,
           'images'                 => "",
           'pickup_code'            => "",
           'tracking_number'        => "",
           'qr_image'               => "",
           'offer_price'            => $request->offer_price,
           'sender_name'            => $request->sender_name,
           'sender_phone'           => $request->sender_phone,
           'pickup_address'         => $request->pickup_address,
           'pickup_geo_location'    => $request->pickup_geo_location,
           'receiver_name'          => $request->receiver_name,
           'receiver_phone'         => $request->receiver_phone,
           'receiver_address'       => $request->receiver_address,
           'receiver_geo_location'  => $request->receiver_geo_location,
        ]);

        $pickup_code = Helpers::generate_random_code(BcoPercel::class, "pickup_code", 6);
        $tracking_number = "bVon-" . Helpers::generate_random_code(BcoPercel::class, "tracking_number", 6);
        $qr_code = QrCode::format('png')->generate(Helpers::generate_random_code(BcoPercel::class, "pickup_code", 6));
        $path = auth()->id() . '/percel/' . $percel->id .'/pick_up_code.png';
        $image_path = auth()->id() . '/percel/' . $percel->id;
        $images_path_list = [];

        for ($i = 0; $i < count($request->images); $i++) {
            $images_path_list[] = $request->file("images.{$i}")->storeAs(
                $image_path,
                $request->file("images.{$i}")->getClientOriginalName().'.'.$request->file("images.{$i}")->extension(),
                'user_upload'
            );
        }

        Storage::disk('user_upload')->put($path, $qr_code);

        $percel->update([
            'tracking_number'   => $tracking_number,
            'pickup_code'       => $pickup_code,
            'qr_image'          => $path,
            "images"            => json_encode($images_path_list),
        ]);

        return new BcoPercelCollection(BcoPercel::where('id', $percel->id)->first());

    }
    public function p_request(Request $request)
    {
        if(!$request->query('parcel_id')) return response()->json(["errors"=>["parcel_id" => "parcel id is required"]], 422);

        $parcel = auth()->user()->percel()->where('id', $request->query('parcel_id'));
        if($parcel->count() === 0) return response()->json(["errors"=>["parcel_id" => "invalid parcel id"]], 422);

        return $parcel->first()->percel_request()->paginate(10);
    }
}
