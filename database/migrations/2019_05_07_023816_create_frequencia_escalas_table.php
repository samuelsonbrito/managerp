<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequenciaEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencias_escalas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('escala_id');
            $table->unsignedInteger('colaborador_id');
            $table->integer('dia');
            $table->string('motivo_ausencia')->nullable();
            $table->enum('frequencia', ['PRESENTE', 'FALTA'])->default('PRESENTE');
            $table->string('substituto_avulso')->nullable();
            $table->unsignedInteger('substituto_extra')->nullable();
            $table->enum('tipo_substituto', ['NENHUM', 'AVULSO', 'PAGANDO FALTA'])->default('NENHUM');

            $table->foreign('escala_id')->references('id')->on('escalas');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->foreign('substituto_extra')->references('id')->on('colaboradores');
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
        Schema::dropIfExists('frequencias_escalas');
    }
}
