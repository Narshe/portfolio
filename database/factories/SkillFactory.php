<?php

use Faker\Generator as Faker;

$factory->define(App\Skill::class, function (Faker $faker) {
    return [
        'name' => 'test1'.$faker->word,
        'url'  => $faker->url,
        'category_id' => function() {
            return factory(App\Category::class)->create()->id;
        },
        'level_id' => function() {
            return factory(App\Level::class)->create()->id;
        },
        'description' => $faker->paragraph,
        'visible' => 1
    ];
});
