<?php

namespace App\Model\Withdrawal;

use App\Model\CommonModel;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends CommonModel
{
    use WithdrawalRelationship;
}
