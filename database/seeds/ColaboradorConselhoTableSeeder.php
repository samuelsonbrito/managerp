<?php

use Illuminate\Database\Seeder;

class ColaboradorConselhoTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\ColaboradorConselhoProfissional::class, 20)->create();
    }
}