<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * -----------------------------------------------------------------------
 * Cria a tabela Produtos
 * -----------------------------------------------------------------------
 * 
 * Cria a tabela "produtos" no banco de dados.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class CreateProdutosTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('imagem');
            $table->integer('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
