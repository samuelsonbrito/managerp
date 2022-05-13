<?php

use Illuminate\Database\Seeder;

class AdmissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Admissao::class, 10)->create();
    }
}
