<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

/**
 * -----------------------------------------------------------------------
 * Controller do usuário
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para as ações de 
 * autenticação e usuário.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 27/01/2020
 */
class UserControler extends Controller
{
    /**
     * Realiza o login do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Realiza o logout do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Cria um novo usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Altera as informações do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Excluí um usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        return redirect()->back();
    }
}
