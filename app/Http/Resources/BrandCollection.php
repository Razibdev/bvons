<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandCollection extends JsonResource
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
            "brand_name"         => $this->name,
            "brand_url"      => $this->url,
            "brand_image"        => $this->brand_image,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
        ];
    }
}
