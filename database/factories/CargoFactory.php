<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Cargo::class, function (Faker $faker) {
    return [
        'descricao' => $faker->name,
    ];
});
