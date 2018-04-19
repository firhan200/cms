<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ContactUs::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'message' => $faker->text(150),
        'is_deleted' => 0
    ];
});
