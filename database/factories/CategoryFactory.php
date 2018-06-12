<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'type' => 'App\Skill'
    ];
});
