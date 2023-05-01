<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;
use App\Model\Ecommerce\EcoMedia;

class BdealerProductStock extends CommonModel
{
    public static function stock($product_id, $bdealer_id)
    {
        $pStockAdd = BdealerProductStock::where('product_id', $product_id)
            ->where('bdealer_id', $bdealer_id)
            ->where('type', 'add')
            ->get()
            ->pluck('quantity')->sum();

        $pStockSub = BdealerProductStock::where('product_id', $product_id)
            ->where('bdealer_id', $bdealer_id)
            ->where('type', 'sub')
            ->get()
            ->pluck('quantity')->sum();

        return $pStockAdd - $pStockSub;
    }

    public function product(){
        return $this->belongsTo('App\Model\Ecommerce\Api\EcoProduct', 'product_id')->select('id', 'product_name');
    }


    public function media(){
        return $this->hasOne(EcoMedia::class, 'product_id', 'product_id')->select('id', 'product_image', 'product_id');
    }
}
