<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\EcoMedia;
use Faker\Generator as Faker;

$factory->define(EcoMedia::class, function (Faker $faker) {
    $products = EcoProduct::all()->pluck('id')->toArray();
    return [
        "product_color" => $faker->hexColor,
        "product_image" => "product/" . random_int(1,4) . ".png",
        "product_id" =>  factory(App\Model\Ecommerce\Api\EcoProduct::class, 1)->create()->first()->id,
    ];
});
