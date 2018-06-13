<?php

use Faker\Generator as Faker;

$factory->define(App\Realisation::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'category_id' => function() {
            return factory('App\Category')->create(['type' => App\Realisation::class])->id;
        },
        'company' => $faker->company,
        'date_begin' => $faker->dateTimeThisYear,
        'date_end' => $faker->dateTimeThisMonth,
        'position' => 'Front end',
        'visible' => 1
    ];
});
