<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periodo');
            $table->string('primeiro_dia');
            $table->integer('quantidade_dias');
            $table->string('turno')->nullable();
            $table->unsignedInteger('unidade_id')->references('id')->on('unidades');
            $table->unsignedInteger('setor_id')->references('id')->on('setores');
            $table->unsignedInteger('cargo_id')->references('id')->on('cargos');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('escalas');
    }
}
