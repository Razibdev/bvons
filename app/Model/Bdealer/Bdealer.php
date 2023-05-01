<?php

namespace App\Model\Bdealer;

use App\KuHelpers\Helpers;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Village;
use App\Model\Area\Zone;
use App\Model\CommonModel;
use App\Model\Ecommerce\Api\EcoOrder;
use App\User;
use phpDocumentor\Reflection\Types\Integer;

class Bdealer extends CommonModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
    public function type()
    {
        return $this->belongsTo(BdealerType::class, 'bdealer_type_id', 'id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function transactions()
    {
        return $this->hasMany(BdealerTransaction::class)->orderByDesc('id');
    }
    public function recharge()
    {
        return $this->transactions()
            ->where('bdealer_transaction_category_id', 1)
            ->where('type', 'c')
            ->pluck('amount')
            ->sum();
    }
    public function purchase()
    {
        return $this->transactions()
            ->where('bdealer_transaction_category_id', 2)
            ->where('type', 'd')
            ->pluck('amount')
            ->sum();
    }
    public function sell()
    {
        return $this->transactions()
            ->where('bdealer_transaction_category_id', 3)
            ->where('type', 'c')
            ->pluck('amount')
            ->sum();
    }
    public function balance()
    {
        $credit = $this->transactions()->where('type', 'c')->pluck('amount')->sum();
        $debit = $this->transactions()->where('type', 'd')->pluck('amount')->sum();
        return $credit - $debit;
    }

    public function orders()
    {
        return $this->hasMany(BdealerOrder::class);
    }

    public function eco_orders()
    {
        return $this->hasMany(EcoOrder::class, 'assign_bdealer_id', 'id');
    }
    public function complete_orders()
    {
        return $this->orders()->where('status', 'complete')->get();
    }
    public function my_assign_orders()
    {
        return $this->hasMany(BdealerOrder::class, 'assigned_to', 'id');
    }
    public function complete_assign_orders()
    {
        return $this->my_assign_orders()->where('status', 'complete')->get();
    }

    public function products()
    {
        return $this->hasMany(BdealerProductStock::class, 'bdealer_id', 'id');
    }
    public function purchase_products()
    {
        return $this->products()->where('type', 'add')->get();
    }
    public function sold_products()
    {
        return $this->products()->where('type', 'sub')->get();
    }
    public function total_sell_amount()
    {
        return $this->complete_assign_orders()->pluck('amount')->sum();
    }
    public function total_purchase_amount()
    {
        return $this->complete_orders()->pluck('amount')->sum();
    }
    public function total_purchase_quantity()
    {
        return $this->purchase_products()->pluck('quantity')->sum();
    }
    public function total_sell_quantity()
    {
        return $this->sold_products()->pluck('quantity')->sum();
    }


    public function bdProduct(){
        return $this->hasMany('App\Model\Bdealer\BdealerProduct', 'bdealer_type_id');
    }


}
