<?php

namespace App\Model\Transaction;

use App\Model\CommonModel;


class Transaction extends CommonModel
{
    use TransactionRelationship;
    protected $guarded = ['id'];
    protected $dates = [ 'check_date'];

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
//    public function getHumanDateAttribute(){
//        return $this->created_at->diffForHumans();
//    }


    public static function credit()
    {
        return static::where('amount_type', 'c');
    }
    public static function creditSum()
    {
        return static::credit()->get()->pluck('amount')->sum();
    }

    public static function debit()
    {
        return static::where('amount_type', 'd');
    }
    public static function debitSum()
    {
        return static::debit()->get()->pluck('amount')->sum();
    }
}
