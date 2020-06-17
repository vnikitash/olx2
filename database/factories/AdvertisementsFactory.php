<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advertisement;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(40),
        'price' => random_int(1, 100),
        'category_id' => 1,
        'user_id' => 1,
    ];
});
