<?php

namespace App\Exports;

use App\Model\Withdrawal\Withdrawal;
use Maatwebsite\Excel\Concerns\FromCollection;


class WithdrawalExports implements FromCollection
{

    protected $withdrawal;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $withdrawals = Withdrawal::where('status', 'accepted')->latest()->get();
        $withdrawalCollection = [["id", "user_name", "payment_method", "payment_method_details", "amount"]];
        foreach ($withdrawals as $withdrawal) {
            $withdrawalCollection[] = [
                "id"                        => $withdrawal->id,
                "user_name"                 => $withdrawal->user->name,
                "payment_method"            => $withdrawal->user->payment_method($withdrawal->payment_method_id)->method,
                "payment_method_details"    => $withdrawal->user->payment_method($withdrawal->payment_method_id)->details,
                "amount"                    => $withdrawal->amount,
            ];
        }

//        dd($withdrawalCollection);
        return collect($withdrawalCollection);
    }


}
