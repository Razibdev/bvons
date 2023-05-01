<?php

namespace App\Http\Requests;

use App\Model\Bdealer\BdealerProduct;
use Illuminate\Foundation\Http\FormRequest;

class BdealerOrderAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "address" => ["required"],
            "data" => ["required"],
            "data.*.product_id" => ["required", "integer"],
            "data.*.price" => ["required", "numeric"],
            "data.*.specification" => ["required", "array"],
            "data.*.specification.*.size" => ["required"],
            "data.*.specification.*.quantity" => ["required"],
        ];
    }



    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $products = $validator->getData()["data"];
            $bdealerTypeId = auth()->user()->bdealerType()->id;
            $not_bdealer_product = [];
            $invalid_price = [];
            $invalid_minimum_quantity = [];
            $invalid_balance = null;

            $totalAmount = 0;
            $bdealer_user_blance = auth()->user()->b_dealer->balance();

            foreach ($products as $product) {
                $bdealer_product = BdealerProduct::where("product_id", $product['product_id']);
                $totalQuantity = collect($product["specification"])->pluck('quantity')->sum();
                if($bdealer_product->count()) {
                    if($bdealer_product->where('bdealer_type_id', $bdealerTypeId)->count()) {
                        $product_db_price = $bdealer_product->where('bdealer_type_id', $bdealerTypeId)->first()->purchase_price;
                        $minimum_quantity = $bdealer_product->where('bdealer_type_id', $bdealerTypeId)->first()->minimum_quantity;
                        $totalQuantityOrdered = collect($product['specification'])->pluck('quantity')->sum();
                        if($product_db_price != $product['price']) $invalid_price[] = "product id {$product['product_id']} price doesn't match";
                        if($totalQuantityOrdered < $minimum_quantity) $invalid_minimum_quantity[] = "product id {$product['product_id']} :  minimum order quantity {$minimum_quantity}";
                    }
                    $totalAmount += $product["price"] * $totalQuantity;
                } else {
                    $not_bdealer_product[] = "product id {$product['product_id']} doesn't belongs to bdealer";
                }
            }

            if($totalAmount > $bdealer_user_blance) $invalid_balance = "insufficient user balance";

            if(count($not_bdealer_product)) $validator->errors()->add("not_bdealer_product", $not_bdealer_product);
            if(count($invalid_price)) $validator->errors()->add("invalid_product_price", $invalid_price);
            if(count($invalid_minimum_quantity)) $validator->errors()->add("invalid_minimum_quantity", $invalid_minimum_quantity);
            if($invalid_balance) $validator->errors()->add("invalid_balance", $invalid_balance);


        });
    }
}
