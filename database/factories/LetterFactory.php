<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Letter;
use Faker\Generator as Faker;

$factory->define(Letter::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(500),
        'to_user_id' => $faker->numberBetween(1, 10),
        'from_user_id' => $faker->numberBetween(1, 10),
    ];
});
