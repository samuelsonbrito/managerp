<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admissao::class, function (Faker $faker) {
    return [
        'cargo_id' => $faker->numberBetween(1, 4),
        'colaborador_id' => $faker->numberBetween(1, 10),
        'horario_trabalho_id' => $faker->numberBetween(1, 3),
        'experiencia_id' => $faker->numberBetween(1, 2),
        'data_admissao' => $faker->date($format = 'Y-m-d', $max = '2017-05-02'),
        'data_exame_admissional' => $faker->date($format = 'Y-m-d', $max = '2019-04-02'),
        'salario' => 1000.50,
        'regime_trabalho' => 'PLATONISTA',
        'primeiro_emprego' => 0,
        'vale_transporte_desconto' => 0,
        'contrato_registrado_outra_empresa' => 0,
        'created_by' => 1,
        'updated_by' => 1
    ];
});