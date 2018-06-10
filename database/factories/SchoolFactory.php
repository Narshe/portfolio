<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city' => $faker->name,
        'description' => $faker->paragraph,
        'url' => $faker->url,
        'date_begin' => $faker->dateTimeThisYear,
        'date_end' => $faker->dateTimeThisMonth
    ];
});
