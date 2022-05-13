<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Documento::class, function (Faker $faker) {
    return [
        'rg' => $faker->numberBetween(00000000, 99999999),
        'orgao_emissor' => 'SSP',
        'rg_data_emissao' => $faker->date(),
        'colaborador_id' => $faker->numberBetween(1, 20),
        'cpf' => $faker->numberBetween(00000000000, 99999999999),
        'pis' => $faker->numberBetween(00000000000, 99999999999),
        'data_inscricao_pis' => $faker->date(),
        'titulo_eleitor' => $faker->numberBetween(00000000000, 99999999999),
        'titulo_eleitor_zona' => $faker->numberBetween(0000, 9999),
        'titulo_eleitor_secao' => $faker->numberBetween(0000, 9999),
        'ctps' => $faker->numberBetween(0000000000, 9999999999),
        'ctps_serie' => $faker->numberBetween(0000, 9999),
        'ctps_uf' => 'AM',
        'ctps_data_emissao' => $faker->date(),
        'titulo_eleitor_uf' => 'AM',
        'created_by' => 1,
        'updated_by' => 1
    ];
});