<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencaColaboradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenca_colaboradors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colaborador_id');
            $table->unsignedInteger('licenca_id');
            $table->date('inicio');
            $table->date('fim');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->foreign('licenca_id')->references('id')->on('licencas');
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
        Schema::dropIfExists('licenca_colaboradors');
    }
}
