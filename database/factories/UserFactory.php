<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'npk' => $faker->randomNumber($nbDigits = 6, $strict = false),
        'role' => 3,
    ];
});


