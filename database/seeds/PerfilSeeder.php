<?php

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    public function run()
    {
        Perfil::create([
            'descricao' => 'admin'
        ]);
    }
}