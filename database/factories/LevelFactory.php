<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'value' => rand(1,3)
    ];
});
