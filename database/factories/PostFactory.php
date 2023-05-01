<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Post\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1, 20),
        'body' => $faker->paragraph,
        'media' => json_encode($faker->rgbColorAsArray)
    ];
});
