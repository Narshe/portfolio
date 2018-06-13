<?php

use Faker\Generator as Faker;

$factory->define(App\Media::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'alt'  => $faker->word
    ];
});
