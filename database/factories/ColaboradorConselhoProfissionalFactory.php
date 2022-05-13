<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ColaboradorConselhoProfissional::class, function (Faker $faker) {
    return [
        'colaborador_id' => $faker->numberBetween(1, 20),
        'conselho_id' => $faker->numberBetween(1, 10),
        'numero_conselho' => $faker->numberBetween(00000000000, 99999999999),
        'data_emissao' => $faker->date(),
        'data_validade' => $faker->date($format = 'Y-m-d', $max = '2019-03-02'),
        'uf' => 'AM',
        'created_by' => 1,
        'updated_by' => 1
    ];
});