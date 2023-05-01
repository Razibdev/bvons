<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\EcoShop;
use App\Model\Ecommerce\EcoSize;
use Faker\Generator as Faker;
use App\Model;



$factory->define(EcoProduct::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
    $sizes = ['s', 'm', 'l', 'xl', 42, 33, 49, '3m', '2 years', '5 years'];
    $sizeIndexes = array_rand($sizes, random_int(1, count($sizes)-1));
    $sizeValue = "";
    foreach ($sizeIndexes as $sizeIndex) {
        $sizeValue .= $sizes[$sizeIndex] . ",";
    }
    $categories = EcoCategory::all()->pluck('id')->toArray();
    $sub_c = EcoSubCategory::all()->pluck('id')->toArray();
    $shop = EcoShop::all()->pluck('id')->toArray();

    $premium_price = random_int(50, 10000);
    return [
        "product_name" => $faker->productName,
        "description" => $faker->paragraph,
        "product_size" =>  trim($sizeValue, ','),
        "product_quantity" => random_int(50, 10000),
        "premium_price" => $premium_price,
        "user_price" => $premium_price + 20,
        "vendor_id" => random_int(1, 2),
        "shop_id" => $shop[array_rand($shop, 1)],
        "category_id" => $categories[array_rand($categories, 1)],
        "subcategory_id" => $sub_c[array_rand($sub_c, 1)],
    ];
});

