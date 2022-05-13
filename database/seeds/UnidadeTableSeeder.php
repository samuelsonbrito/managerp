<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UnidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            'nome'=>'PLATÃO ARAÚJO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'28 DE AGOSTO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'JOÃO LÚCIO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'ICAM',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'MAT ALVORADA',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'MAT AZILDA MARREIRO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'MAT NAZIRA DAOU',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'SPA E POLICLINICA DR DANILO CORREIA',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'JOSE LINS',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'ZENO LANZINE',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'BENEFICIENTE PORTUGUESA',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'POLICLINICA PAM CODAJAS',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'HOSPITAL TROPICAL',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'POLICLINICA. PAM CENTRO',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'SEBRAE',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'SEGEAM',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('unidades')->insert([
            'nome'=>'SESI',
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
