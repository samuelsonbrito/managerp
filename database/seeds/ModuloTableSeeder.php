<?php

use Illuminate\Database\Seeder;
use App\Models\Modulo;

class ModuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modulo::create([
            'modulo' => 'Colaboradores',
            'chave' => 'colaborador',
            'descricao' => 'Gerenciamento de Colaboradores'
        ]);

        Modulo::create([
            'modulo' => 'Setores',
            'chave' => 'setor',
            'descricao' => 'Gerenciamento de Setores'
        ]);

        Modulo::create([
            'modulo' => 'Escalas',
            'chave' => 'escala',
            'descricao' => 'Gerenciamento de Escalas'
        ]);

        Modulo::create([
            'modulo' => 'Feriados',
            'chave' => 'feriado',
            'descricao' => 'Gerenciamento de Feriados'
        ]);

        Modulo::create([
            'modulo' => 'Unidades',
            'chave' => 'unidade',
            'descricao' => 'Gerenciamento de Unidades'
        ]);

        Modulo::create([
            'modulo' => 'Contratos',
            'chave' => 'contrato',
            'descricao' => 'Gerenciamento de Contratos'
        ]);
    }
}
