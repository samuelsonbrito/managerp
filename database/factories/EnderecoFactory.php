<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Endereco::class, function (Faker $faker) {
    return [
        'numero' => $faker->numberBetween(1000, 2000),
        'rua' => $faker->name(),
        'bairro' => $faker->name(),
        'colaborador_id' => $faker->numberBetween(1, 20),
        'cep' => $faker->numberBetween(100000000, 200000000),
        'cidade' => $faker->numberBetween(100000000, 200000000),
        'uf' => 'AM',
        'created_by' => 1
    ];
});