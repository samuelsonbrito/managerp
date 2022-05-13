<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetoresProfissionais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setores_profissionais', function (Blueprint $table) {
            $table->unsignedInteger('setor_id');
            $table->unsignedInteger('colaborador_id');
            $table->primary(['setor_id', 'colaborador_id']);
            $table->foreign('setor_id')->references('id')->on('setores');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
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
        Schema::dropIfExists('setores_profissionais');
    }
}
