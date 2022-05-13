<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PerfilSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CargoTableSeeder::class);
        $this->call(PapeisSeederTable::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(ConselhoProfissionalSeeder::class);
        $this->call(HorariosTrabalhoSeeder::class);
        $this->call(IntervaloSeeder::class);
        $this->call(ExperienciaTableSeeder::class);
        $this->call(ContratoTableSeeder::class);
        $this->call(UnidadeTableSeeder::class);
        $this->call(SetorTableSeeder::class);
        $this->call(LicencaSeeder::class);
        $this->call(ModuloTableSeeder::class);

        if (App::environment() == 'dev') {
//            $this->call(ColaboradorSeeder::class);
//            $this->call(DocumentoTableSeeder::class);
//            $this->call(ColaboradorConselhoTableSeeder::class);
//            $this->call(EnderecoTableSeeder::class);
//            $this->call(AdmissaoTableSeeder::class);
        }

    }
}