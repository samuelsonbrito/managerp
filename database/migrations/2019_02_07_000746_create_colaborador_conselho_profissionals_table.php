<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColaboradorConselhoProfissionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores_conselhos_profissionais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_conselho');
            $table->date('data_emissao');
            $table->date('data_validade');
            $table->string('uf', 2);

            $table->unsignedInteger('colaborador_id');
            $table->unsignedInteger('conselho_id');

            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->foreign('conselho_id')->references('id')->on('conselhos_profissionais');

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
        Schema::dropIfExists('colaboradores_conselhos_profissionais');
    }
}
