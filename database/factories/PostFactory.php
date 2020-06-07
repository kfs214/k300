<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(500),
        'user_id' => $faker->numberBetween(1, 10),
        'board_id' => $faker->numberBetween(1, 10),
        'created_at' => $faker->dateTime,
    ];
});
