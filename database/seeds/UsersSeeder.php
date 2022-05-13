<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Master',
            'username' => 'admin',
            'email' => 'master@gmail.com',
            'perfil_id' => 1,
            'status' => 'ativo',
            'email_verified_at' => now(),
            'password' =>  Hash::make('erp_s2019@admin*'), // secret
            'remember_token' => str_random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


//        factory(App\User::class)->create();
    }
}