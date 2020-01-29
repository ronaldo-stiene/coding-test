<?php

namespace App\Http\Services;

use App\Models\Endereco;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * -----------------------------------------------------------------------
 * User Maker
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para criar novos 
 * usuários.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserMaker
{
    /**
     * Cria um usuário.
     *
     * @param string $nome
     * @param string $telefone
     * @param array $endereco
     * @return User
     */
    public function criarUser(string $name, string $email, string $password, bool $admin): User
    {
        DB::beginTransaction();
        $usuario = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'admin' => $admin,
            ]);
        DB::commit();

        return $usuario;
    }
}