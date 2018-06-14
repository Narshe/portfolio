<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'value' => rand(0,5)
    ];
});
