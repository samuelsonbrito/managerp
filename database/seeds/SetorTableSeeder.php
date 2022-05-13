<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SetorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setores')->insert([
            'nome'=>'SETOR TESTE',
            'insalubridade'=> 0,
            'unidade_id'=> 1,
            'created_by'=> 1,
            'updated_by'=> 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
