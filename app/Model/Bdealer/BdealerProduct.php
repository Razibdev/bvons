<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;
use App\Model\Ecommerce\Api\EcoProduct;

class BdealerProduct extends CommonModel
{
    public function product()
    {
        return $this->belongsTo(EcoProduct::class);
    }

    public function products()
    {
        return $this->belongsTo(EcoProduct::class, 'product_id')->select('id', 'product_name', 'product_size', 'deleted_at');
    }



    public function bdealer_type()
    {
        return $this->belongsTo(BdealerType::class, 'bdealer_type_id', 'id');
    }

    public static function fellow_prices($product_id, $bdealer_type_id)
    {
        $dealer_products = static::where('product_id', $product_id)
            ->where('bdealer_type_id', '>', $bdealer_type_id);
        if($dealer_products->count()) {
            return $dealer_products->get()
                ->map(function($bdealer_product) {
                    return [
                        "name" => $bdealer_product->bdealer_type->name ?? "",
                        "price" => $bdealer_product->purchase_price ?? 0
                    ];
                });
        } else {
            return [
                [
                    "name" => "",
                    "price" => 0
                ]
            ];
        }


    }


    public function media(){
        return $this->hasOne('App\Model\Ecommerce\EcoMedia', 'product_id', 'product_id');
    }
}
