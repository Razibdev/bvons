<?php

namespace App\Model\Bcourier;

use App\KuHelpers\Helpers;
use App\Model\CommonModel;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BcoDeliveryBoy extends CommonModel
{
    // Status List
    //-> pending (default)
    //-> cancel
    //-> active
    //-> banned
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function percel_request()
    {
        return $this->hasMany(BcoRequest::class);
    }

    public static function get_percel()
    {
        // pickup_area - where area like
        // delivery_area - where area like
        // offer_price - sortBy asc/desc
        // weight - sortBy asc/desc
        // delivery_distance

        $delivery_boy_lat = request()->query('lat') ?? 25.22;
        $delivery_boy_lon = request()->query('lon') ?? 62.33;
        $distance = request()->query('distance') ?? 50000;
        $pickup_area = request()->query('pickup_area') ?? null;


        $delivery_area = request()->query('delivery_area') ?? null;
//        $weight = request()->query('weight') ?? null;
//        $offer_price = request()->query('offer_price') ?? null;
        $sort_by = request()->query('sort_by') ?? null;


        $percel =  BcoPercel::select([
            'bco_percels.id as id',
            'bco_percels.name',
            'bco_percel_types.name as percel_type',
            'bco_percels.offer_price',
            'bco_percels.tracking_number',
            'bco_percels.weight',
            'bco_percels.images',
            'bco_percels.sender_name',
            'bco_percels.sender_phone',
            'bco_percels.pickup_address',
            'bco_percels.pickup_geo_location',
            'bco_percels.receiver_name',
            'bco_percels.receiver_phone',
            'bco_percels.receiver_address',
            'bco_percels.receiver_geo_location',
            'bco_percels.status',
            'bco_percels.created_at'
        ])
            ->join('bco_percel_types','bco_percel_types.id','=','bco_percels.bco_percel_type_id')
            ->where('bco_percels.user_id', '!=', auth()->id())
            ->where('bco_percels.status', 'waiting')
            ->where('bco_percels.created_at', '>=', Carbon::now()->subDays(2));

        if($pickup_area) $percel->where('pickup_address', 'LIKE', "%{$pickup_area}%");
        if($delivery_area) $percel->where('receiver_address', 'LIKE', "%{$delivery_area}%");

        $order_by = ["column" => "bco_percels.created_at", "format" => "desc"];

//        if($weight) $order_by = ["column" => "weight", "format" => $weight];
//        if($offer_price) $order_by = ["column" => "offer_price", "format" => $offer_price];

        if($sort_by) {
            if($sort_by === "offered_price_asc") {
                $order_by = ["column" => "bco_percels.offer_price", "format" => "asc"];
            } else if ($sort_by === "offered_price_desc") {
                $order_by = ["column" => "bco_percels.offer_price", "format" => "desc"];
            } else if ($sort_by === "weight_asc") {
                $order_by = ["column" => "bco_percels.weight", "format" => "asc"];
            } else if ($sort_by === "weight_desc") {
                $order_by = ["column" => "bco_percels.weight", "format" => "desc"];
            }
        }
        $percel = $percel->orderBy($order_by["column"], $order_by["format"])->paginate(10);
        $percel_array_with_paginate = $percel->toArray();

        $percel_array = $percel->toArray()["data"];;
        $percel_array_filter = [];
        for($i = 0; $i < count($percel_array); $i++) {
            $pickup_geo_location = explode(",", $percel_array[$i]["pickup_geo_location"]);
            if(count($pickup_geo_location) > 1) {
                $km = Helpers::distanceInKmBetweenEarthCoordinates(
                    (double) $delivery_boy_lat,
                    (double) $delivery_boy_lon,
                    (double) $pickup_geo_location[0],
                    (double) $pickup_geo_location[1]
                );

                if($km <= $distance) {
                    $percel_array_filter[$i] = $percel_array[$i];
                    $percel_array_filter[$i]["km"] = $km;
                    $images = [];
                    foreach (json_decode($percel_array_filter[$i]["images"], true) ?? []  as $img) {
                        $images[] = Storage::disk('user_upload')->url($img);
                    }
                    $percel_array_filter[$i]["images"] = $images;
                }
            }
        }


        if($sort_by) {
            $percel_array_with_paginate["data"] = array_values($percel_array_filter);
        } else {
            $percel_array_with_paginate["data"] = array_values(Arr::sort($percel_array_filter, function ($value) {
                return $value['km'];
            }));
        }


        return $percel_array_with_paginate;
    }
}
