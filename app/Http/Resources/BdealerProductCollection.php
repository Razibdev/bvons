<?php

namespace App\Http\Resources;

use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


class BdealerProductCollection extends JsonResource
{
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
        $product_image = [];
        if($request->id) {
            if($this->media()->count()) {
                foreach ($this->media as $media) {
                    $product_image[] = asset('/storage/' . $media->product_image);
                }
            } else {
                $product_image[] = Storage::disk('img_not_found')->url('pro_img_not_found.png');
            }

        } else {
            $product_image = $this->media()->count() ? asset('/storage/' . $this->media->first()->product_image) : Storage::disk('img_not_found')->url('pro_img_not_found.png');
        }

        $products = [
            "productId"     => $this->product_id,
            "categoryId"    => $this->category_id,
            "productName"   => $this->product_name,
            'productSize'   => $spltDescription,
            "productImage"  => $product_image,
            "minimumQuantity"  => $this->minimum_quantity,
            "inMyStock"     => BdealerProductStock::stock($this->product_id, auth()->user()->b_dealer->id ?? null),
            "productPrice"  => $this->purchase_price,
            "fellowPrices"  => BdealerProduct::fellow_prices($this->product_id, $this->bdealer_type_id)
        ];

        if($request->id) { $products["description"] = $this->description; }

        return $products;
    }
}
