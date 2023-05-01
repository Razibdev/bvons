<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                => $this->id,
            "shop_name"         => $this->shop_name,
            "shop_address"      => $this->shop_address,
            "shop_image"        => $this->shop_image,
            "vendor"            => $this->vendor->name,
            "status"            => $this->status,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
        ];

    }
}
