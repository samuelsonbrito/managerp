<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colaborador_id');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->string('rg');
            $table->char('orgao_emissor', 10);
            $table->date('rg_data_emissao');
            $table->string('cpf')->unique();
            $table->string('pis')->nullable();
            $table->date('data_inscricao_pis');
            $table->string('titulo_eleitor');
            $table->string('titulo_eleitor_zona');
            $table->string('titulo_eleitor_secao');
            $table->char('titulo_eleitor_uf', 3);
            $table->string('ctps');
            $table->string('ctps_serie');
            $table->char('ctps_uf');
            $table->date('ctps_data_emissao');
            $table->string('certificado_reservista')->nullable();
            $table->string('certificado_reservista_serie')->nullable();
            $table->string('certificado_reservista_categoria')->nullable();
            $table->string('cnh_numero')->nullable();
            $table->enum('cnh_categoria', ['A', 'B', 'AB', 'C', 'D', 'E'])->nullable();
            $table->date('cnh_data_validade')->nullable();
            $table->date('cnh_data_emissao')->nullable();
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
        Schema::dropIfExists('documentos');
    }
}