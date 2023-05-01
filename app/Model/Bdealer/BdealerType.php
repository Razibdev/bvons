<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;

class BdealerType extends CommonModel
{
    public function products()
    {
        return $this->hasMany(BdealerProduct::class, 'bdealer_type_id', 'id');
    }

    public function bdealer_product_with_id($product_id)
    {
        return $this->products()->where('product_id', $product_id)->count() ? $this->products()->where('product_id', $product_id)->first() : [];
    }
}
