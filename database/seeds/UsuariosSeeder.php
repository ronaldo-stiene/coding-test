<?php

use App\User;
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
 * @since 29/01/2020
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
        DB::table('users')->insert([
            [
                'name' => 'João da Silva',
                'email' => 'joao@email.com',
                'password' => Hash::make("senha"),
                'admin' => true,
            ],
        ]);

        factory(User::class, 3)->create();
    }
}
