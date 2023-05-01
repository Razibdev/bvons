<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'user_type' => $this->user_type,
            'product_url' => $this->product_url,
            'product_name' => $this->product_name,
            'color' => $this->color,
            'size' => $this->size,
            'price' => $this->price,
            'premium_price' => $this->premium_price,
            'quantity' => $this->quantity,
            'user_phone' => $this->user_phone,
            'session_id' => $this->session_id,
            'product_media' => $this->product_media,
            'product' => $this->product
        ];
    }
}
