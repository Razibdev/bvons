<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderDetailsCollection extends JsonResource
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
            'id' => $this->id,
            'product_name' => $this->products->product_name,
            'shop_name' => $this->products->shop->shop_name,
            'description' => $this->products->description,
            'product_size' => $this->products->product_size,
            'products' => $this->products,
            // 'sliders_status' => $this->sliders_status,
            // 'product_color' => $this->product_color,
            // 'product_discount' => $this->product_discount,
            // 'product_quantity' => $this->product_quantity,
            // 'product_price' => $this->product_price,
            // 'product_image' => $this->product_image,
            // 'shop_name' => $this->shop->shop_name,
               
        ];
        //return parent::toArray($request);
    }
}
