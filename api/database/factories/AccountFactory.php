<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'balance' => 99
    ];
});
