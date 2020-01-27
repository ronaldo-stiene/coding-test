<?php

use App\Models\Endereco;
use Illuminate\Database\Seeder;

/**
 * -----------------------------------------------------------------------
 * Seeder de Fornecedores
 * -----------------------------------------------------------------------
 * 
 * Cria os endereços dos fornecedores que serão usados na aplicação.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class EnderecosSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        DB::table('enderecos')->insert([
            [
                'cep' => '08111-500',
                'rua' => 'Rua René Carneiro Fernandes',
                'numero' => '449',
                'complemento' => null,
                'bairro' => 'Jardim das Oliveiras',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
            ],
            [
                'cep' => '31560-160',
                'rua' => 'Rua Conceição Maia',
                'numero' => '64',
                'complemento' => null,
                'bairro' => 'Santa Amélia',
                'cidade' => 'Belo Horizonte',
                'estado' => 'Minas Gerais',
            ],
            [
                'cep' => '17051-240',
                'rua' => 'Travessa Francisca Júlia do Nascimento',
                'numero' => '103',
                'complemento' => null,
                'bairro' => 'Jardim de Allah',
                'cidade' => 'Bauru',
                'estado' => 'São Paulo',
            ],
            [
                'cep' => '74553-610',
                'rua' => 'Rua Santa Maria',
                'numero' => '376',
                'complemento' => null,
                'bairro' => 'Vila Perdiz',
                'cidade' => 'Goiânia',
                'estado' => 'Goiás',
            ],
            [
                'cep' => '29052-120',
                'rua' => 'Avenida João Baptista Parra',
                'numero' => '89',
                'complemento' => null,
                'bairro' => 'Praia do Suá',
                'cidade' => 'Vitória',
                'estado' => 'Espírito Santo',
            ],
            [
                'cep' => '88110-200',
                'rua' => 'Rodovia BR-101',
                'numero' => '2363',
                'complemento' => null,
                'bairro' => 'Barreiros',
                'cidade' => 'São José',
                'estado' => 'Santa Catarina',
            ],
            [
                'cep' => '41750-420',
                'rua' => 'Rua do Sossego',
                'numero' => '8890',
                'complemento' => null,
                'bairro' => 'Armação',
                'cidade' => 'Salvador',
                'estado' => 'Bahia',
            ]
        ]);
    }
}
