<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicencaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licencas')->insert([
            'tipo'=>'Licença Médica',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('licencas')->insert([
            'tipo'=>'Licença Maternidade - 120 Dias',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('licencas')->insert([
            'tipo'=>'Licença Maternidade - Por Aborto Não Criminoso',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('licencas')->insert([
            'tipo'=>'Casamento',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('licencas')->insert([
            'tipo'=>'Licença Paternidade',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('licencas')->insert([
            'tipo'=>'Serviço Militar Obrigatório',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('licencas')->insert([
            'tipo'=>'Óbito',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
