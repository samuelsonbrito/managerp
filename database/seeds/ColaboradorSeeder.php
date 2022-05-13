<?php

use Illuminate\Database\Seeder;

class ColaboradorSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Colaborador::class, 20)->create();
    }
}