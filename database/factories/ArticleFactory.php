<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'summary' => $faker->text($maxNbChars = 200),
        'body' => $faker->text($maxNbChars = 800),
        'tags' => 'Laravel,Bootstrap, jQuery',
        'is_active' => 1,
        'is_deleted' => 0
    ];
});
