<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HorariosTrabalhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'HRA COM ADM',
            'inicio_expediente'=>'08:00',
            'fim_expediente'=>'17:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'HRA COM ADM',
            'inicio_expediente'=>'08:00',
            'fim_expediente'=>'18:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'07:00',
            'fim_expediente'=>'12:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'07:00',
            'fim_expediente'=>'14:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'07:00',
            'fim_expediente'=>'16:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'07:00',
            'fim_expediente'=>'19:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'19:00',
            'fim_expediente'=>'00:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'19:00',
            'fim_expediente'=>'02:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'19:00',
            'fim_expediente'=>'04:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'PLANTÃO',
            'inicio_expediente'=>'19:00',
            'fim_expediente'=>'07:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'HRA ESTAGIO MANHA',
            'inicio_expediente'=>'08:00',
            'fim_expediente'=>'12:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('horarios_trabalho')->insert([
            'descricao_periodo'=>'HRA ESTAGIO TARDE',
            'inicio_expediente'=>'13:00',
            'fim_expediente'=>'17:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
