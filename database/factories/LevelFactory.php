<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {
    return [
        'name' => 'level1',
        'value' => rand(0,5)
    ];
});
