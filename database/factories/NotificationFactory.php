<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Notification::class, function (Faker $faker) {
    return [
        'action' => 'new',
        'object' => 'feedback',
        'link' => 'admin/contact_us/2',
        'is_active' => 1,
        'is_deleted' => 0
    ];
});
