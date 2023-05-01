<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;


class BdealerOrderDetail extends CommonModel
{
    public function border()
    {
        return $this->belongsTo(BdealerOrder::class, 'bdealer_order_id', 'id');
    }

//    protected $casts = [
//        'created_at'  => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d',
//    ];


}
