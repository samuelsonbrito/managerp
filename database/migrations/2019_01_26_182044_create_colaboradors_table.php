<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColaboradorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricula')->nullable();
            $table->string('nome');
            $table->string('fone_contato');
            $table->enum('estado_civil', [
                'SOLTEIRO(A)',
                'CASADO(A)',
                'VIÚVO(A)',
                'SEPARADO(A)',
                'DIVORCIADO(A)',
                'UNIÃO ESTÁVEL',
            ]);
            $table->string('nome_pai')->nullable();
            $table->string('nome_mae');
            $table->string('nacionalidade');
            $table->date('data_nascimento');
            $table->string('local_nascimento');
            $table->string('estado_nascimento')->nullable();
            $table->enum('grau_instrucao', [
                "PRIMEIRO GRAU INCOMPLETO",
                "PRIMEIRO GRAU COMPLETO",
                "SEGUNDO GRAU COMPLETO",
                "SEGUNDO GRAU INCOMPLETO",
                "SUPERIOR INCOMPLETO",
                "SUPERIOR COMPLETO",
                "PÓS-GRADUAÇÃO",
                "MESTRADO",
                "DOUTORADO",
                "TÉCNICO"
            ]);
            $table->enum('raca_cor', [
                'INDÍGENA',
                'BRANCA',
                'NEGRA',
                'PARDA',
            ]);
            $table->boolean('residencia_propria')->default(false)->comment('Valor "0" para Não, e "1" para Sim')	;
            $table->boolean('recurso_fgts')->default(false)->nullable()->comment('Valor "0" para Não, e "1" para Sim')	;
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('colaboradores');
    }
}