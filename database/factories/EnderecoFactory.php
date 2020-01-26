<?php

use App\Models\Endereco;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Address as BrAddress;

/**
 * -----------------------------------------------------------------------
 * Fábrica de dados dos Endereços
 * -----------------------------------------------------------------------
 * 
 * Gerador de dados dos Endereços dos fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Definição da fabrica de dados dos endereços, utilizando o Faker.
 */
$factory->define(Endereco::class, function (Faker $faker) {
    $faker->addProvider(new BrAddress($faker));
    return [
        'cep' => $faker->postcode,
        'rua' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'cidade' => $faker->city,
        'estado' => $faker->stateAbbr,
        'fornecedor_id' => 0 // @todo Verificar a possibilidade de não atribuir um valor 0.
    ];
});

/**
 * Após a criação, o campo "fornecedor_id" é setado para o mesmo valor do "id".
 */
$factory->afterCreating(App\Models\Endereco::class, function ($endereco, $faker) {
    $endereco->fornecedor_id = $endereco->id; // @todo Verificar a possibilidade de usar o fornecedor id.
    $endereco->save();
});
