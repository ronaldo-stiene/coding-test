<?php

namespace App\Http\Services;

use App\User;

/**
 * -----------------------------------------------------------------------
 * User Updater
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos necessários para alterar as 
 * informações dos usuários.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 29/01/2020
 */
class UserUpdater extends Updater
{
    /**
     * Altera as informações do usuário.
     *
     * @param integer $id
     * @param array $dados
     * @return User
     */
    public function atualizarUser(int $id, array $dados): User
    {
        $user = User::find($id);
        
        parent::atualizarCampo('name', $user, $dados);
        parent::atualizarCampo('email', $user, $dados);
        parent::atualizarCampo('admin', $user, $dados);
        $user->save();

        return $user;
    }
}
