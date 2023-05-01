<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;


class BdealerOrderCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_assigned = $this->assigned_to === auth()->user()->b_dealer->id;
        $borders = parent::toArray($request);
        if($is_assigned) {
            $borders = Arr::except($borders, ["bdealer_id", "pin", "assigned_to", "delivery_address", "seen_status"]);
        }
        return $borders;
    }
}
