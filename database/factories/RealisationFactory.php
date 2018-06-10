<?php

use Faker\Generator as Faker;

$factory->define(App\Realisation::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => function() {
            return factory('App\Category')->create(['type' => App\Experience::class])->id;
        },
        'company' => $faker->name,
        'date_begin' => $faker->dateTimeThisYear,
        'date_end' => $faker->dateTimeThisMonth,
        'position' => 'Front end',
        'visible' => 1
    ];
});
