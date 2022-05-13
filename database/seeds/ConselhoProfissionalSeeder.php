<?php

use Illuminate\Database\Seeder;

class ConselhoProfissionalSeeder extends Seeder
{
    public function run()
    {

        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE ASSISTÊNCIA SOCIAL (CRAS)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHOS REGIONAL DE ENFERMAGEM (COREN)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE FARMÁCIA (CRF)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE FONOAUDIOLOGIA (CRFA)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE FISIOTERAPIA E TERAPIA OCUPACIONAL (CREFITO)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE MEDICINA (CRM)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE NUTRIÇÃO (CRN)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);
        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE ODONTOLOGIA (CRO)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);

        DB::table('conselhos_profissionais')->insert([
            'nome'=>'CONSELHO REGIONAL DE PSICOLOGIA (CRP)',
            'created_by'=> 1,
            'updated_by'=>1
        ]);

    }

}