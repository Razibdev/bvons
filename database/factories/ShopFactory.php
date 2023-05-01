<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Ecommerce\EcoShop;
use Faker\Generator as Faker;

$factory->define(EcoShop::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    return [
        "shop_name" => $faker->department,
        "shop_address" => $faker->address,
        "shop_image" => "shop/sampleimage.jpg",
        "vendor_id" => random_int(1, 2),
    ];
});
