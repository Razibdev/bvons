<?php


namespace App\Http\Controllers\Bdealer;

use App\Http\Controllers\Controller;
use App\KuHelpers\Helpers;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Bdealer\BdealerTransaction;
use App\Model\CashBackTransaction\CashBackTransaction;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Ecommerce\EcoBvonTransaction;
use App\Model\Ecommerce\EcoEntrepreneurTransaction;
use App\Model\Ecommerce\EcoReserveTransaction;
use App\User;
use Illuminate\Support\Facades\DB;


class BdealerCustomerOrderController extends Controller
{


    public function bdealerCustomerOrderComplete(EcoOrder $order_id)
    {
        DB::beginTransaction();
        //TODO:: Sr amount gap

        // bdealer id
        $bdealer_id = auth()->user()->b_dealer->id;


        if($order_id->order_status == 'cancel' || $order_id->order_status == 'complete') return response()->json(["error" => "Order already cancel or completed"]);




        if($order_id->assign_bdealer_id !== $bdealer_id) return response()->json(["error" => "Invalid Bdealer"]);




        // order details with products
        $order_details = $order_id->manyOrders()->with('products')->get();



        // stock check
        // $od = order_detail
        // $prodi = product

        $stock_results = collect([]);
        $stock_error = false;
        $stock_error_message = "";
        foreach ($order_details as $od) {
            $prodi = $od->products;
            $stock = BdealerProductStock::stock($prodi->id, $bdealer_id);
            $prodi_q = $od->product_quantity;

            if($stock < $prodi_q) {
                $stock_results->add([
                    "product_name" => $prodi->product_name,
                    "stock" => $stock,
                    "quantity" => $prodi_q,
                ]);
            }
        }

        if($stock_results->count()) {
            $stock_error = true;
            foreach ($stock_results as $result) {
                $stock_error_message .= "{$result["product_name"]} out of stock\n";
            }
        }

        if($stock_error) return response()->json(["error" => $stock_error_message]);










        // order user referred by id
        $has_referred_by = $order_id->user->referred_by != NULL;










        /// full order summary
        $full_order_summary = [];






        // check this is the first order by the order user
        $first_order = EcoOrder::where('user_id', $order_id->user_id)->where('order_status', 'complete')->count() === 0;











        // give registration bonus
        if($order_id->is_default === 0) {
            $user_registration_time = $order_id->user->created_at;
            $order_time = $order_id->created_at;
            $order_time_diff = $user_registration_time->diffInMinutes($order_time);
            $registration_time_limit = json_decode(AdminSetting::getSetting("User Registration Bonus Time Limit"), true);
            $registration_minimum_order_amount = AdminSetting::getSetting("User Registration Bonus Minimum Order Amount");
            $order_time_limit = Helpers::hourMinuteToMinute($registration_time_limit["H"], $registration_time_limit["M"]);
            if($first_order && $order_time_diff <= $order_time_limit && $order_id->order_amount >= $registration_minimum_order_amount) {
                $referral_user = User::validateReferralId($order_id->user->referred_by);
                if($referral_user) {
                    Helpers::giveRegistrationBonus($referral_user);
                }
            }
        }



        foreach ($order_details as $detail) { //each product foreach start



            // single product in order details
            $product = $detail->products;





            $single_product_price_distribution_summary = [
                "product_{$product->id}" => []
            ];

            // validate product sr amount
            $sr_amount_array = Helpers::validateCommaSeperatedNumericString($product->sr_amount, 'array');

            // total amount array sum
            $sr_amount_array_sum = collect($sr_amount_array)->sum();


            $entrepreneur_amount = ($product->bvon_price - $product->production_price) * $detail->product_quantity;
            $bvon_amount = $product->production_price * $detail->product_quantity;
            $store_amount = $product->store_amount * $detail->product_quantity;
            $reserve_amount = (($product->premium_price - ($sr_amount_array_sum + $product->store_amount)) - $product->bvon_price) * $detail->product_quantity;
            $sr_amount_given = false;
            $store_amount_given = false;


            // give bvon amount
            if($bvon_amount != 0) {
                $eco_bvon_transaction = EcoBvonTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $bvon_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["bvon_amout_given"] = [
                    "id" => $eco_bvon_transaction->id,
                    "amount" => $eco_bvon_transaction->amount,
                ];
            }

            // give entrepreneur amount
            if($entrepreneur_amount != 0) {
                $eco_entrepreneur_transaction = EcoEntrepreneurTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $entrepreneur_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["entrepreneur_amout_given"] = [
                    "transaction_id" => $eco_entrepreneur_transaction->id,
                    "amount" => $eco_entrepreneur_transaction->amount
                ];
            }



            // give SR amount
            if($has_referred_by && count($sr_amount_array) > 0) {
                if(count($sr_amount_array) == 1 && $sr_amount_array[0] == 0) {} else {
                    $given_sr_amount = $this->giveSrAmount($sr_amount_array, $order_id, $detail);
                    $single_product_price_distribution_summary["product_{$detail->products->id}"]["sr_amout_given"] = $given_sr_amount;
                    $sr_amount_given = true;
                }
            }

            // INFO: Give store amount whene there is a store

            // give reserve amount
            $total_amount_have_to_give_to_sr = 0;
            for($i = 0; $i < count($sr_amount_array); $i++) {
                if($i == 0) {
                    $total_amount_have_to_give_to_sr += ($sr_amount_array[$i] + $detail->product_price - $detail->products->premium_price) * $detail->product_quantity;
                } else {
                    $total_amount_have_to_give_to_sr += $sr_amount_array[$i] * $detail->product_quantity;
                }
            }

            if(!$sr_amount_given && gettype($sr_amount_array) == "array") {
                $reserve_amount += $total_amount_have_to_give_to_sr;
            } else {
                if($given_sr_amount["sr_amount_total_given"] < $total_amount_have_to_give_to_sr) {
                    $reserve_amount += $total_amount_have_to_give_to_sr - $given_sr_amount["sr_amount_total_given"];
                }
                // subtract sr gap amount from bdealer account
                if($given_sr_amount["sr_gap_amount"] > 0) {
                    $ewalet_transaction_taken = BdealerTransaction::create([
                        "bdealer_id" => $bdealer_id,
                        "bdealer_transaction_category_id" => 3,
                        "type" => "d",
                        "amount" => $given_sr_amount["sr_gap_amount"] * $detail->product_quantity,
                        "data" => json_encode([
                            "order_id" => $order_id->id,
                        ]),
                        "message" => ucfirst("{$product->name} : Sr amount has been debited for , Order no: {$order_id->order_serial}"),
                    ]);
                    $single_product_price_distribution_summary["product_{$product->id}"]["bdealer_ewalet_transaction_taken"] = [
                        "transaction_id" => $ewalet_transaction_taken->id,
                        "amount" => $ewalet_transaction_taken->amount
                    ];
                }
            }
            if(!$store_amount_given) $reserve_amount += $store_amount;
            if($reserve_amount != 0) {
                $eco_reserve_transaction = EcoReserveTransaction::create([
                    "eco_order_id" => $detail->order_id,
                    "eco_order_details_id" => $detail->id,
                    "eco_product_id" => $detail->product_id,
                    "amount" => $reserve_amount,
                ]);
                $single_product_price_distribution_summary["product_{$product->id}"]["reserve_amout_given"] = [
                    "transaction_id" => $eco_reserve_transaction->id,
                    "amount" => $eco_reserve_transaction->amount
                ];

            }



            /*
                disable first order cashback and now cashback bonus has been given to all
                $first_order = EcoOrder::where('user_id', $order_id->user_id)->where('order_status', 'complete')->count() === 0;

                info:: to enable first order replace the if section in give cashback comment below
                        code --> if($first_order && $slider = $detail->products->product_under_slider()) {
            */
            // give cashback
            if(!$first_order) {
                if($slider = $detail->products->product_under_slider()) {
                    $product_cashback_amount = (($detail->product_price * (int)$slider->percentage) / 100) * $detail->product_quantity;
                    $cashback_transaction = CashBackTransaction::create([
                        "user_id" => $order_id->user_id,
                        "product_id" => $detail->product_id,
                        "order_id" => $detail->order_id,
                        "product_name" => "",
                        "type" => "c",
                        "amount" => $product_cashback_amount,
                        "message" => "Congratulations! Cashback amount credited for {$product->product_name} purchase"
                    ]);
                    $single_product_price_distribution_summary["product_{$product->id}"]["cashback_amout_given"] = [
                        "transaction_id" => $cashback_transaction->id,
                        "amount" => $cashback_transaction->amount
                    ];
                }

            }

            // update product quantity
            $updated_quantity = $product->product_quantity - $detail->product_quantity;
            $detail->products()->update([
                "product_quantity" => $updated_quantity
            ]);
            $full_order_summary["order_given"][] = $single_product_price_distribution_summary;

        } //each product foreach end





        // Give First order cashback
        $first_order_percentage = (double) AdminSetting::getSetting('First Order Cashback Percentage');
        if($first_order && $first_order_percentage > 0) {
            $first_order_cashback_amount = ($order_id->order_amount * $first_order_percentage)/100;
            $cashback_transaction = CashBackTransaction::create([
                "user_id" => $order_id->user_id,
                "order_id" => $order_id->id,
                "type" => "c",
                "amount" => round($first_order_cashback_amount, 2),
                "message" => "Congratulations for first order! Cashback amount credited for order serial {$order_id->order_serial}"
            ]);

            $full_order_summary["order_given"]["first_order_cashback"] = [
                "transaction_id" => $cashback_transaction->id,
                "amount" => $cashback_transaction->amount
            ];
        }


        // payment taken
        $payments = $order_id->payments()->where(function($q){
            return $q->where('order_type', '=', 'Cashback')->orWhere('order_type', '=', 'E-wallet');
        });
        if($payments->count() > 0) {
            $payment_taken = [];
            foreach ($payments->get() as $payment) {
                if($payment->order_type == 'Cashback') {
                    $cashback_transaction_taken = CashBackTransaction::create([
                        "user_id" => $order_id->user_id,
                        "order_id" => $payment->order_id,
                        "product_name" => "",
                        "type" => "d",
                        "amount" => $payment->amount,
                        "message" => "Cashback amount debited for Order No: #{$order_id->order_serial}"
                    ]);

                    $cashback_transaction_given = BdealerTransaction::create([
                        "bdealer_id" => $bdealer_id,
                        "bdealer_transaction_category_id" => 3,
                        "type" => "c",
                        "amount" => $payment->amount,
                        "data" => json_encode([
                            "order_id" => $payment->order_id,
                        ]),
                        "message" => ucfirst("Product sell (From customer's cashback wallet), Order no: {$order_id->order_serial}"),
                    ]);

                    $payment_taken["cashback"] = [
                        "transaction_id" => $cashback_transaction_taken->id,
                        "amount" => $cashback_transaction_taken->amount
                    ];
                    $payment_given["cashback_payment_given"] = [
                        "transaction_id" => $cashback_transaction_given->id,
                        "amount" => $cashback_transaction_given->amount
                    ];
                }
                else if($payment->order_type == 'E-wallet') {
                    $user_transaction_taken = $order_id->user->transactions()->create([
                        "category" => "product_purchase",
                        "amount_type" => "d",
                        "amount" => $payment->amount,
                        "data" => json_encode([
                            "order_id" => $payment->order_id,
                        ]),
                        "message" => ucfirst("E-wallet balance used for order no: {$order_id->order_serial}")
                    ]);

                    $ewalet_transaction_given = BdealerTransaction::create([
                        "bdealer_id" => $bdealer_id,
                        "bdealer_transaction_category_id" => 3,
                        "type" => "c",
                        "amount" => $payment->amount,
                        "data" => json_encode([
                            "order_id" => $payment->order_id,
                        ]),
                        "message" => ucfirst("Product sell (From customer's E-wallet), Order no: {$order_id->order_serial}"),
                    ]);

                    $payment_taken["e-walet"] = [
                        "transaction_id" => $user_transaction_taken->id,
                        "amount" => $user_transaction_taken->amount
                    ];

                    $payment_given["ewalet_payment_given"] = [
                        "transaction_id" => $ewalet_transaction_given->id,
                        "amount" => $ewalet_transaction_given->amount
                    ];
                }
            }

            $full_order_summary["order_taken"][] = $payment_taken;
            $full_order_summary["bdealer_transaction"][] = $payment_given;
        }





        $order_complete = $order_id->update([
            'order_status' => 'complete',
            'payment_status' => 'paid',
            'complete_order_detail' => json_encode($full_order_summary)
        ]);
        if($order_complete) {

            // updated bdealer product stock
            foreach ($order_details as $od) {
                $prodi = $od->products;
                $prodi_q = $od->product_quantity;

                BdealerProductStock::create([
                    "bdealer_id" => $bdealer_id,
                    "product_id" => $prodi->id,
                    "name" => "sell",
                    "message" => "{$prodi->product_name} has been sold",
                    "type" => "sub",
                    "quantity" => $prodi_q,
                ]);
            }






            DB::commit();
            return response()->json(['success' => 'Order Complete Successful']);
        }
    }




    protected function giveSrAmount($sr_amount_array, $order_id, $detail) {
        $sr_amount_collection = collect($sr_amount_array);
        $sr_tree_upper = collect([]);
        for($i = 0; $i < $sr_amount_collection->count(); $i++) {
            $sr_user = false;
            if($sr_tree_upper->count() < 1) {
                if($order_id->is_default === 1 && $order_id->user->has_job()) {
                    $sr_user = $order_id->user;
                } else {
                    $sr_user = User::validateReferralId($order_id->user->referred_by);
                }
            } else {
                if($sr_tree_upper->last()->has_job()) {
                    $sr_user = User::validateReferralId($sr_tree_upper->last()->referred_by);
                } else {
                    $sr_user = false;
                }
            }

            if($sr_user) $sr_tree_upper->push($sr_user);
            else break;
        }

        $sr_amount_given = [];
        $sr_total_given_amount = 0;
        $sr_gap_amount = 0;
        for($i = 0; $i < $sr_tree_upper->count(); $i++) {
            if($i == 0) {
                $sr_gap_amount = $detail->product_price - $detail->products->premium_price;
                $sr_amount = ($sr_amount_collection[$i] + ($detail->product_price - $detail->products->premium_price)) * $detail->product_quantity;
            } else {
                $sr_amount = $sr_amount_collection[$i] * $detail->product_quantity;
            }

            $sr_user_give_amount = $sr_tree_upper[$i]->transactions()->create([
                "category" => "product_purchase_bonus",
                "amount_type" => "c",
                "amount" => $sr_amount,
                "data" => json_encode([
                    "order_id" => $detail->order_id,
                    "order_details_id" => $detail->id,
                    "product_id" => $detail->product_id,
                ]),
                "message" => ucfirst("you have got product purchase bonus from {$detail->products->product_name}")
            ]);

            $sr_total_given_amount += $sr_user_give_amount->amount;

            if($sr_user_give_amount) {
                $sr_amount_given["sr_amount_given_to_user"][] = [
                    "user_id" => $sr_user_give_amount->user_id,
                    "amount" => $sr_user_give_amount->amount
                ];
            }

        }
        $sr_amount_given["sr_amount_total_given"] = $sr_total_given_amount;
        $sr_amount_given["sr_gap_amount"] = $sr_gap_amount;
        return $sr_amount_given;
    }

    public function bdealerCustomerOrderForward(EcoOrder $order_id)
    {
        // bdealer id
        $bdealer_id = auth()->user()->b_dealer->id;
        if($order_id->assign_bdealer_id !== $bdealer_id) return response()->json(["error" => "Invalid Bdealer"]);

        $order_id->assign_bdealer_id = NULL;

        $forwarded = $order_id->save();
        if($forwarded) return $forwarded;

    }

}
