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

        // Criação dos dados manualmente.
        // $this->manualSeed();
    }

    /**
     * Realiza a inserção manual dos dados.
     *
     * @return void
     */
    private function manualSeed(): void
    {
        DB::table('fornecedores')->insert([
            [
                'nome' => 'Frutas da Serra',
                'telefone' => '(11) 5042-1273',
                'endereco_id' => 1,
            ],
            [
                'nome' => 'Casa das Carnes',
                'telefone' => '(11) 3065-6594',
                'endereco_id' => 2,
            ],
            [
                'nome' => 'Hortelaria',
                'telefone' => '(11) 3905-3912',
                'endereco_id' => 3,
            ],
            [
                'nome' => 'P H Distribuidora',
                'telefone' => '(11) 4869-2572',
                'endereco_id' => 4,
            ],
            [
                'nome' => 'Pescado',
                'telefone' => '(11) 2292-9438',
                'endereco_id' => 5,
            ],
            [
                'nome' => 'New Drink',
                'telefone' => '(11) 2142-9735',
                'endereco_id' => 6,
            ],
            [
                'nome' => 'Lev Guloseimas',
                'telefone' => '(11) 5516-8864',
                'endereco_id' => 7,
            ]
        ]);
    }
}
