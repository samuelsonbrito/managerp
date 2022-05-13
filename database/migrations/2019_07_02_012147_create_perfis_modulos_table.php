<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfisModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfis_modulos', function (Blueprint $table) {
            $table->unsignedInteger('perfil_id');
            $table->unsignedInteger('modulo_id');
            $table->boolean('cadastrar')->nullable();
            $table->boolean('editar')->nullable();
            $table->boolean('visualizar')->nullable();
            $table->boolean('excluir')->nullable();
            $table->foreign('perfil_id')->references('id')->on('perfis');
            $table->foreign('modulo_id')->references('id')->on('modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfis_modulos');
    }
}
