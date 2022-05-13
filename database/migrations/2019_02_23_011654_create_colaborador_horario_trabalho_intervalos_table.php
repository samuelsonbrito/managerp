<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColaboradorHorarioTrabalhoIntervalosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_trabalho_intervalos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colaborador_id');
            $table->unsignedInteger('i_trabalho_id');
            $table->unsignedInteger('h_trabalho_id');
            $table->foreign('i_trabalho_id')->references('id')->on('intervalos');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->foreign('h_trabalho_id')->references('id')->on('horarios_trabalho');
            $table->date('data_registro');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_trabalho_intervalos');
    }
}
