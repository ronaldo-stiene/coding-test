<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * -----------------------------------------------------------------------
 * Seeder de Usuários
 * -----------------------------------------------------------------------
 * 
 * Cria um usuário para autenticar na aplicação.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class UsuariosSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'nome' => 'João da Silva',
                'email' => 'joao@email.com',
                'senha' => Hash::make("senha"),
            ],
        ]);
    }
}
