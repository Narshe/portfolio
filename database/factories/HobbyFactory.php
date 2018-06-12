<?php

use Faker\Generator as Faker;

$factory->define(App\Hobby::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'category_id' => function() {
            return factory('App\Category')->create(['type' => 'App\Hobby']);
        },
        'url' => $faker->url,
        'visible' => 1
    ];
});
