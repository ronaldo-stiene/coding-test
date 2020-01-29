<?php

namespace App\Http\Services;

use App\User;
use Illuminate\Support\Facades\DB;

/**
 * -----------------------------------------------------------------------
 * User Destroyer
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para excluir usuários.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserDestroyer
{
    /**
     * Excluí o usuário.
     *
     * @param integer $id
     * @return string
     */
    public function removerUser(int $id): string
    {
        $nome = '';
        DB::transaction(function () use ($id, &$nome) {
            $user = User::find($id);
            $nome = $user->name;
            $user->delete();
        });
        return $nome;
    }
}
