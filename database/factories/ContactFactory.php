<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {

    return [
        'email' => $faker->email,
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'content' => $faker->paragraph,
        'client_ip' => '',
        'is_read' => 0
    ];
});
