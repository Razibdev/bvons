<?php

namespace App\Http\Resources;

use App\Model\Bdealer\BdealerProductStock;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoMedia;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\Ecommerce\Api\EcoOrder;
use Illuminate\Support\Facades\Storage;

class EcoOrderCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $order_details = $this->manyOrders()->get(["id", "product_id", "product_price", "product_quantity", "color", "size"]);
        $newOrdersDetails = [];
        $is_bdealer = auth()->user()->b_dealer ? true : false;

        for ($i = 0; $i < count($order_details); $i++) {
            $product = EcoProduct::where('id', $order_details[$i]->product_id)->withTrashed()->first(["product_name"]);
            $media = EcoMedia::where([
                'product_id' => $order_details[$i]->product_id,
                'product_color' => $order_details[$i]->color
            ])->first(["product_image"]);

            $in_stock = [];
            if($is_bdealer) {
                $in_stock = [
                    "in_stock" => BdealerProductStock::stock($order_details[$i]->product_id, auth()->user()->b_dealer->id)
                ];
            }

            if($media) $media = ["product_image" => url('storage/' . $media->product_image)];
            else $media = ["product_image" => Storage::url('img-not-found/pro_img_not_found.png')];
            $newOrdersDetails[$i] = array_merge(
                $product ? $product->toArray() : [],
                $media ? $media : [],
                $in_stock,
                $order_details[$i] ? $order_details[$i]->toArray() : []
            );
        }



        $data = [
            "order" => parent::toArray($request),
            "order_details" => $newOrdersDetails,
            "order_payments" => $this->payments,
        ];
        if($is_bdealer) {
            $data["users_info"] = [
                "customer" => [
                    "name" => $this->user->name,
                    "phone" => $this->user->phone,
                    "type" => $this->user->verified ? 'Verified' : 'General',
                ],
                "assigned_bp" => [
                    "name" => User::validateReferralId($this->user->referred_by)->name,
                    "phone" => User::validateReferralId($this->user->referred_by)->phone,
                ]
            ];
        }

        return $data;

    }
}
