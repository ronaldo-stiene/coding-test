<?php

use App\Models\Produto;
use Faker\Generator as Faker;

/**
 * -----------------------------------------------------------------------
 * Fábrica de dados dos Produtos
 * -----------------------------------------------------------------------
 * 
 * Gerador de dados dos Produtos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Fabrica de dados dos produtos.
 */
$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => 'Produto ' . $faker->randomNumber(6),
        'imagem' => $faker->imageUrl(800, 800, 'cats'),
        'quantidade' => $faker->numberBetween(0,15),
        'fornecedor_id' => $faker->numberBetween(1, 7)
    ];
});
