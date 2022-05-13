<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cargo_id');
            $table->unsignedInteger('colaborador_id');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->unsignedInteger('experiencia_id');
            $table->foreign('experiencia_id')->references('id')->on('experiencias');
            $table->date('data_admissao');
            $table->date('data_exame_admissional');
            $table->decimal('salario', 10, 2);
            $table->string('regime_trabalho')->default();
            $table->boolean('primeiro_emprego')->default(false);
            $table->boolean('readmissao')->default(false);
            $table->boolean('vale_transporte_desconto')->default(false)->comment('Vale Transporte, proceder com o Desconto?');
            $table->boolean('contrato_registrado_outra_empresa')->default(false);
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
        Schema::dropIfExists('admissoes');
    }
}