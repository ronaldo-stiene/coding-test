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
        'cep' => $faker->randomNumber(8),
        'rua' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'cidade' => $faker->city,
        'estado' => $faker->stateAbbr,
    ];
});
