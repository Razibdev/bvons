<?php

namespace App\Http\Resources\Bcourier;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


//use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryBoyCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $media = [
            Storage::disk('user_upload')->url($this->pic),
            Storage::disk('user_upload')->url($this->nid_pic),
            Storage::disk('user_upload')->url($this->p_nid_pic),
            Storage::disk('user_upload')->url($this->e_bill_pic),
        ];
        return [
//            'pic' => Storage::disk('user_upload')->url($this->pic),
//            'nid_pic' => Storage::disk('user_upload')->url($this->nid_pic),
//            'p_nid_pic' => Storage::disk('user_upload')->url($this->p_nid_pic),
//            'e_bill_pic' => Storage::disk('user_upload')->url($this->e_bill_pic),
            'present_address' => $this->present_address,
            'permanent_address' => $this->permanent_address,
            "media_url" => $media
        ];
    }
}
