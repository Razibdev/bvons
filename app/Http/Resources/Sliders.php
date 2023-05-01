<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sliders extends JsonResource
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
            'sliders_type' => $this->sliders_type,
            'sliders_name' => $this->sliders_name,
            'sliders_status' => $this->sliders_status,
           
            'sliders_image' =>$this->sliders_image,    
        //     'sliders_image' => 'http://bf.demo/storage/'.$this->sliders_image,    
         ];
    }
}
