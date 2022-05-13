<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntervaloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('intervalos')->insert([
            'hora_inicial'=>'11:00',
            'hora_final'=>'12:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('intervalos')->insert([
            'hora_inicial'=>'11:30',
            'hora_final'=>'12:30',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('intervalos')->insert([
            'hora_inicial'=>'12:00',
            'hora_final'=>'13:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('intervalos')->insert([
            'hora_inicial'=>'12:00',
            'hora_final'=>'14:00',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
