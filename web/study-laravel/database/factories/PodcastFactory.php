<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Podcast::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
