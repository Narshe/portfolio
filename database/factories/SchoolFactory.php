<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'city' => $faker->city,
        'description' => $faker->paragraph,
        'url' => $faker->url,
        'date_begin' => $faker->dateTimeThisYear,
        'date_end' => $faker->dateTimeThisMonth
    ];
});
