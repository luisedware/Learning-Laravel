<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Flyer::class, function (Faker\Generator $faker) {
    return [
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'state' => $faker->state,
        'price' => $faker->numberBetween(1000, 50000),
        'street' => $faker->streetAddress,
        'country' => $faker->country,
        'description' => $faker->text(300),
    ];
});
