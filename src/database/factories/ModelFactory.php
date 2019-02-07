<?php

use Faker\Generator as Faker;

$factory->define(App\Bookdetail::class, function (Faker $faker) {
    $now = \Carbon\Carbon::now();
    return [
        'isbn' => $faker->isbn13,
        'published_date' => $faker->date('Y-m-d', 'now'),
        'price' => $faker->randomNumber(4),
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
