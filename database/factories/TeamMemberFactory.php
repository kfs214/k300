<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TeamMember;
use Faker\Generator as Faker;

$factory->define(TeamMember::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'acode' => $faker->numberBetween(1, 60),
        'user_id' => 1, //factory(App\TeamMember::class),
    ];
});
