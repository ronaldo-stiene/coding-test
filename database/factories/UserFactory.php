<?php

use Faker\Generator as Faker;

/**
 * -----------------------------------------------------------------------
 * Fábrica de dados dos Usuários
 * -----------------------------------------------------------------------
 * 
 * Gerador de dados dos usuários.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */

/**
 * Fabrica de dados dos usuários.
 */
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'admin' => false,
        'password' => Hash::make("senha"),
        'remember_token' => str_random(10),
    ];
});
