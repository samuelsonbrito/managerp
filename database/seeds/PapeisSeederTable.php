<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PapeisSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('papeis')->insert([
            'descricao'=>'FORNECEDOR'
        ]);
        DB::table('papeis')->insert([
            'descricao'=>'CLIENTE'
        ]);
    }
}
