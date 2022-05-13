<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('url');
            $table->unsignedInteger('colaborador_id')->nullable();
            $table->unsignedInteger('dependente_id')->nullable();
            $table->unsignedInteger('contrato_id')->nullable();

            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->foreign('dependente_id')->references('id')->on('dependentes');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('anexos');
    }
}
