<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Board;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {
    return [
        'name' => $faker->city . '場' . $faker->randomDigit() . '組',
        'shown_id' => $faker->userName,
        'hidden' => $faker->boolean,
    ];
});
