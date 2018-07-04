<?php

use Faker\Generator as Faker;

$factory->define(App\Hobby::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'description' => 'test1, test2, test3',
        'url' => $faker->url,
        'visible' => 1
    ];
});
