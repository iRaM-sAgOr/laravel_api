<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'title' => $faker->text(50),
        'body' => $faker->text(200)
        
    ];
});
