<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiencias')->insert([
            'descricao'=>'30 + 30 DIAS',
        ]);
        DB::table('experiencias')->insert([
            'descricao'=>'30 + 60 DIAS',
        ]);
        DB::table('experiencias')->insert([
            'descricao'=>'45 + 45 DIAS',
        ]);
        DB::table('experiencias')->insert([
            'descricao'=>'CONTRATO INTERMITENTE',
        ]);
        DB::table('experiencias')->insert([
            'descricao'=>'NÃO VAI FAZER',
        ]);
    }
}
