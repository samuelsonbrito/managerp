<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalasProfissionais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalas_profissionais', function (Blueprint $table) {
            $table->unsignedInteger('escala_id');
            $table->unsignedInteger('colaborador_id');
            $table->primary(['escala_id', 'colaborador_id']);
            $table->string('dias')->nullable();
            $table->foreign('escala_id')->references('id')->on('escalas');
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
        Schema::dropIfExists('escalas_profissionais');
    }
}
