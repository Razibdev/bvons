<?php

namespace App\Model\Bdealer;

use App\Model\CommonModel;
use App\User;


class BdealerOrder extends CommonModel
{

    /*
        Order Status
        1. pending
        2. processing
        3. shipped
        4. complete
        5. cancel
     */

    public function border_details()
    {
        return $this->hasMany(BdealerOrderDetail::class);
    }

    public function bdealer()
    {
        return $this->belongsTo(Bdealer::class);
    }

    public function bdealer_assign_to()
    {
        return $this->belongsTo(Bdealer::class, 'assigned_to', 'id');
    }

    public function user()
    {
        return $this->bdealer->user;
    }

    public function user_assign_to()
    {
        return $this->bdealer_assign_to ? $this->bdealer_assign_to->user : new User();
    }


}
