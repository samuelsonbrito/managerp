<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoColaboradorSetorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_colaborador_setores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('setores');
            $table->string('nome_setor');
            $table->unsignedInteger('colaborador_id');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');

            $table->string('nome_colaborador');
            $table->date('data_entrada');
            $table->date('data_saida')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_colaborador_setores');
    }
}
