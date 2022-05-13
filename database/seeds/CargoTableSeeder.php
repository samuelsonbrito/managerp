<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CargoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargos')->insert([
            'descricao'=>'TÉCNICO(A) EM ENFERMAGEM',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ANALISTA FINANCEIRO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ASSISTENTE ADMINISTRATIVO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ASSISTENTE DE RH',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'AUXILIAR ADMINISTRATIVO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'AUXILIAR DE DEPARTAMENTO PESSOAL',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ENFERMEIRO(A)',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ENFERMEIRO (A) / SUP (A)',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ENG DE SEGURANÇA DO TRABALHO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ESTAGIÁRIO ADMINISTRATIVO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'ESTAGIÁRIO DE ENFERMAGEM',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'FISOTERAPEUTA',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'GERENTE',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'MÉDICO(A) DO TRABALHO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'NUTRICIONISTA',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'PSICOLOGO(A)',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'SUPERVISOR ADMINISTRATIVO I',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'TÉCNICO(A) EM SEGURANÇA DO TRABALHO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('cargos')->insert([
            'descricao'=>'TÉCNICO(A) EM ENFERMAGEM DO TRABALHO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
