<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'uname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'acode' => $faker->numberBetween(1, 60),
        'name_shown' => $faker->boolean,
        'type_shown' => $faker->randomElement([7, 6, 4, 0]),
        'birthday_shown' => $faker->boolean,
        'comment' => $faker->realText(100),
        'remember_token' => Str::random(10),
        'notify_posts' => $faker->randomElement(['push', 'everyday', 'everyweek', 'disabled']),
        'notify_users' => $faker->randomElement(['push', 'disabled']),
        'notify_messages' => $faker->randomElement(['push', 'everyday', 'everyweek', 'disabled']),
    ];
});
