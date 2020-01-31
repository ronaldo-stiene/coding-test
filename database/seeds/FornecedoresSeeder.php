<?php

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

/**
 * -----------------------------------------------------------------------
 * Seeder de Fornecedores
 * -----------------------------------------------------------------------
 * 
 * Cria os fornecedores que serão usados na aplicação.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 25/01/2020
 */
class FornecedoresSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dados gerados pela fábrica.
        factory(Fornecedor::class, 8)->create();
    }
}
