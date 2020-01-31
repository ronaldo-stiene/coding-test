<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * -----------------------------------------------------------------------
 * Cria a tabela fornecedores
 * -----------------------------------------------------------------------
 * 
 * Cria a tabela "fornecedores" no banco de dados.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 25/01/2020
 */
class CreateFornecedoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->bigInteger('telefone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
