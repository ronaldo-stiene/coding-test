<?php

use App\Models\Fornecedor;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Company as BrCompany;
use Faker\Provider\pt_BR\PhoneNumber as BrPhoneNumber;

/**
 * -----------------------------------------------------------------------
 * Fábrica de dados dos Fornecedores
 * -----------------------------------------------------------------------
 * 
 * Gerador de dados dos Fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */

/**
 * Definição da fabrica de dados dos fornecedores, utilizando o Faker.
 * Ao popular o campo "endereco_id", é chamado a fabrica de dados dos endereços.
 */
$factory->define(Fornecedor::class, function (Faker $faker) {
    $faker->addProvider(new BrCompany($faker));
    $faker->addProvider(new BrPhoneNumber($faker));
    return [
        'nome' => $faker->company,
        'telefone' => $faker->cellphoneNumber,
        'endereco_id' => function () {
            return factory(App\Models\Endereco::class)->create()->id;
        }
    ];
});