<?php

namespace App\Http\Resources;

use App\Model\Ecommerce\Api\EcoProduct;
use App\User;
use App\UserJobType;
use Illuminate\Http\Resources\Json\JsonResource;

class EcoProductCollection extends JsonResource
{

    private function calculate_sr_amount($sr_am) {
        $user = request()->user('api');
        $sr_amount = explode(',', $sr_am);
        if($user) {
            if( ($user->check_user_is_verified()) && $user->has_job() ){
                $totalJobType = array_reverse(UserJobType::all()->pluck('name')->toArray());
                $user_jobtype_name = $user->job->job_type->name;
                $sr_amount_wtih_job_type = [];
                for($i = 0; $i < count($totalJobType); $i++) {
                    $sr_amount_wtih_job_type[$totalJobType[$i]] = $sr_amount[$i] ?? 0;
                    if ($user_jobtype_name == $totalJobType[$i]) {
                        break;
                    }
                }
                $sr_amount = $sr_amount_wtih_job_type;
            } else if ($user->check_user_is_verified()) {
                $sr_amount = $sr_amount[0];
            } else {
                $sr_amount = 0;
            }
        } else {
            $sr_amount = 0;
        }
        return $sr_amount;
    }


    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $afDescription = $this->product_size;
        $spltDescription = explode(',', $afDescription);
        $sr_amount = $this->calculate_sr_amount($this->sr_amount);
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'description' =>  $this->description,
            'product_size' => $spltDescription,
            'product_discount' => $this->product_discount,
            'product_quantity' => $this->product_quantity,
            'premium_price' => $this->premium_price,
            'user_price' => $this->user_price,
            'sr_amount' => $sr_amount,
            'shop' => [
                "id" => $this->shop->id,
                "name" => $this->shop->shop_name,
            ],
            'product_media' => $this->media,
            'category' => [
                "id" => $this->category->id,
                "name" => $this->category->category_name,
            ],
            'subcategory' => [
                "id" => $this->sub_category->id,
                "name" => $this->sub_category->sub_category_name,
            ],
            'brand' => [
                "id" => $this->brands->id,
                "name" => $this->brands->name,
            ],
            'slider' => $this->get_slider() ? [
                "id" => $this->get_slider()->id,
                "name" => $this->get_slider()->sliders_name
            ] : null,
            'USEABLE_CASHBACK_PERCENT' => $this->can_use_cashback,
            'product_promote' => $this->product_promote !== null && $this->product_promote !== 0,
        ];
        // return parent::toArray($request);


    }
}
