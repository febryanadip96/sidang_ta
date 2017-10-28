<?php

use Faker\Generator as Faker;

$factory->define(App\Dosen::class, function (Faker $faker) {
    return [
        'kelayakan' => $faker->boolean($chanceOfGettingTrue = 80),
        'user_id' =>function () {
			return factory(App\User::class)->create()->id;
		},
    ];
});
