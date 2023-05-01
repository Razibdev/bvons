<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;

class BdealerTransaction extends CommonModel
{
    public function bdealer()
    {
        return $this->belongsTo(Bdealer::class);
    }

    public function category()
    {
        return $this->belongsTo(BdealerTransactionCategory::class, 'bdealer_transaction_category_id', 'id');
    }
}
