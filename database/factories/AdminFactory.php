<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => sha1('123456'),
        'type' => 0,
        'is_active' => 1,
        'is_deleted' => 0
    ];
});
