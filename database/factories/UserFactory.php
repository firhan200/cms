<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => sha1('123456'), // 123456
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber,
        'remember_token' => null,
        'is_active' => 1,
        'is_deleted' => 0,
    ];
});
