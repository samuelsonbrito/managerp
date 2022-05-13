<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Contrato::class, function (Faker $faker) {
    return [
        'numero'=>rand(1,100),
        'cliente_id'=>\App\Models\Cliente::create([
            'nome' => $faker->name,
            'telefone'=>$faker->phoneNumber,
            'created_by'=>1,
            'updated_by'=>1,
            'cpf_cnpj'=>'782.536.592-53',
        ]),
        'valor'=>$faker->randomFloat(2,0,8),
        'data_assinatura'=>$faker->date('d/m/Y'),
        'data_inicial'=>$faker->date('d/m/Y'),
        'data_fim'=>$faker->date('d/m/Y'),
        'status'=>$faker->randomElement(['VENCIDO','ATIVO','CANCELADO']),
        'created_by'=>1,
        'updated_by'=>1
    ];
});
