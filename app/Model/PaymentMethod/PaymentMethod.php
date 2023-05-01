<?php

namespace App\Model\PaymentMethod;

use App\Model\CommonModel;

class PaymentMethod extends CommonModel
{
    use PaymentMethodRelationship;
    protected $guarded = ['id'];
}
