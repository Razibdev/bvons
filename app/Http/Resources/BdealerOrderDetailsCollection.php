<?php

namespace App\Http\Resources;

use App\KuHelpers\Helpers;
use App\Model\Bdealer\BdealerProductStock;
use Illuminate\Http\Resources\Json\JsonResource;

class BdealerOrderDetailsCollection extends JsonResource
{
    public static $wrap = "data";
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $is_assigned = $this->assigned_to === auth()->user()->b_dealer->id;
        $order_details = $this->border_details;
        $filter_order = [];

        foreach ($order_details as $order_detail) {
            $order_detail_json_to_array = json_decode($order_detail->product_json);
            $product_details = $order_detail_json_to_array->product_details;
            $db_order_details = $order_detail_json_to_array->order_details;
            $filter_product = [
                "product_id" => $product_details->id,
                "product_name" => $product_details->product_name,
                "product_price" => $db_order_details->price,
                "product_media" => Helpers::product_single_media($product_details->media),
                "specification" => $db_order_details->specification,
                "note" => $db_order_details->note,
                "quantity" => $order_detail->quantity,
            ];
            if($is_assigned) {
                $filter_product["in_stock"] = BdealerProductStock::stock($product_details->id, $this->assigned_to);
            }
            $filter_order[] = $filter_product;


        }


        return [
            "order_info" => [
                "user" => [
                    "name" => $this->user()->name,
                    "phone" => $this->user()->phone,
                    "type" => $this->user()->b_dealer->type->name
                ],
                "assign_to" => $this->assigned_to ? [
                    "name" => $this->user_assign_to()->name,
                    "phone" => $this->user_assign_to()->phone,
                ] : [
                    "name" => "Admin",
                    "phone" => "01788999966",
                ],
                "serial" => $this->serial,
                "pin" => $is_assigned ? null : $this->pin,
                "amount" => $this->amount,
                "status" => $this->status,
                "delivery_address" => $this->delivery_address,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "order_details" => $filter_order
        ];
    }
}
