<?php

namespace App;
use App\App\Model\ComisionBonus;
use App\Model\Bcourier\BcoDeliveryBoy;
use App\Model\Bcourier\BcoPercel;
use App\Model\Bdealer\Bdealer;
use App\Model\CashBackTransaction\CashBackTransaction;
use App\Model\Comment\Comment;
use App\Model\Ecommerce\Api\EcoAddress;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\MarchantTransaction;
use App\Model\PaymentMethod\PaymentMethod;
use App\Model\Post\Post;
use App\Model\ShoppingVoucherTransaction;
use App\Model\ShoppingWalletTransaction;
use App\Model\Transaction\Transaction;
use App\Model\User\UserVerification;
use App\Model\User\UserVerificationDetail;
use App\Model\Withdrawal\Withdrawal;

trait UserRelationship {
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function verification()
    {
        return $this->hasOne(UserVerification::class);
    }
    public function verification_details() {
        return $this->hasMany(UserVerificationDetail::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function shoppingVoucherTransactions(){
        return $this->hasMany(ShoppingVoucherTransaction::class);
    }


    public function shoppingWalletTransactions(){
        return $this->hasMany(ShoppingWalletTransaction::class);
    }

    public function merchantTransaction(){
       return $this->hasMany(MarchantTransaction::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function payment_methods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
    public function withdrawals() {
        return $this->hasMany(Withdrawal::class);
    }
    public function cash_back_wallet()
    {
        return $this->hasMany(CashBackTransaction::class);
    }
    public function addresses()
    {
        return $this->hasMany(EcoAddress::class);
    }
    public function orders()
    {
        return $this->hasMany(EcoOrder::class);
    }
    public function delivery_boy()
    {
        return $this->hasOne(BcoDeliveryBoy::class);
    }
    public function percel()
    {
        return $this->hasMany(BcoPercel::class);
    }
    public function b_dealer()
    {
        return $this->hasOne(Bdealer::class);
    }
    public function job()
    {
        return $this->hasOne(UserJob::class);
    }

    public function bdealerType()
    {
        return $this->b_dealer->type;
    }

    public function comision(){
        return $this->hasMany(ComisionBonus::class);
    }
}
