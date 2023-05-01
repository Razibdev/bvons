<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EcoOrderDetailResource extends JsonResource
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
            'product'=> $this->product,
            'product_price' => $this->product_price,
            'product_quantity' => $this->product_quantity,
            'color' => $this->color,
            'size' => $this->size,
            'created_at' => $this->created_at->format('d-m-Y H:i:s')
        ];
    }
}
