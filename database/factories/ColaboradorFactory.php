<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Colaborador::class, function (Faker $faker) {
    return [
        'matricula' => 12312312,
        'nome' => $faker->name(),
        'estado_civil' => $faker->randomElement([
            'Solteiro(a) ',
            'Casado(a) ',
            'Viúvo(a) ',
            'Separado(a) ',
            'União Estável ',
            'Outros '
        ]),
        'nacionalidade' => $faker->name(),
        'nome_pai' => $faker->name(),
        'nome_mae' => $faker->name(),
        'data_nascimento' => $faker->date(),
        'local_nascimento' => $faker->name(),
        'estado_nascimento' => $faker->name(),
        'grau_instrucao' => $faker->randomElement([
            'Primeiro Grau Incompleto',
            'Primeiro Grau Completo',
            'Segundo Grau Completo',
            'Segundo Grau Incompleto',
            'Superior Incompleto',
            'Superior Completo',
            'Mestrado',
            'Doutorado',
            'Técnico',
        ]),
        'raca_cor' => $faker->randomElement([
            'Indígena',
            'Branca',
            'Negra',
            'Parda',
        ]),
        'created_by' => 1
    ];
});