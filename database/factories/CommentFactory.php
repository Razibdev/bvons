<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Comment\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1,50),
        'post_id' => random_int(1,30),
        'body' => $faker->paragraph,
        'media' => json_encode($faker->rgbColorAsArray)
    ];
});
