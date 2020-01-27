<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * -----------------------------------------------------------------------
 * Cria a tabela Endereços
 * -----------------------------------------------------------------------
 * 
 * Cria a tabela "enderecos" no banco de dados, que contém os endereços
 * dos fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class CreateEnderecosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cep');
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('cidade');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
