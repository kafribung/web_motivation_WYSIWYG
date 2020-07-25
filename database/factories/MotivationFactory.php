<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Motivation;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Motivation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => Str::slug($faker->sentence),
        'description' => $faker->paragraph(5),
        'user_id' => 1
    ];
});
