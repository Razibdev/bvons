<?php

namespace App\Http\Resources\Bcourier;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class BcoPercelCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images = [];
        foreach (json_decode($this->images, true) ?? []  as $img) {
            $images[] = Storage::disk('user_upload')->url($img);
        }
        return [
            "id"                    => $this->id,
            "name"                  => $this->name,
            "percel_type"           => $this->type->name,
            "pickup_code"           => $this->pickup_code,
            "offer_price"           => $this->offer_price,
            "tracking_number"       => $this->tracking_number,
            "weight"                => $this->weight,
            "images"                => $images,
            "qr_image"              => $this->qr_image ? Storage::disk('user_upload')->url($this->qr_image) : null,
            "sender_name"           => $this->sender_name,
            "pickup_address"        => $this->pickup_address,
            "sender_phone"          => $this->sender_phone,
            "pickup_geo_location"   => $this->pickup_geo_location,
            "receiver_name"         => $this->receiver_name,
            "receiver_phone"        => $this->receiver_phone,
            "receiver_address"      => $this->receiver_address,
            "receiver_geo_location" => $this->receiver_geo_location,
            "status"                => $this->status,
            "created_at"            => $this->created_at,
            "updated_at"            => $this->updated_at,
        ];
    }
}
