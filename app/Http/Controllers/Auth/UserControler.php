<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Services\UserDestroyer;
use App\Http\Services\UserMaker;
use App\Http\Services\UserUpdater;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     * Direciona para a páginad e login.
     *
     * @return View
     */
    public function index(): View
    {
        return view('site.login');
    }

    /**
     * Realiza o login do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->back()
                ->withErrors('Usuário e/ou senha inválidos');
        }
        return redirect()->route('home');
    }

    /**
     * Realiza o logout do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->back();
    }

    /**
     * Cria um novo usuário.
     *
     * @param UserFormRequest $request
     * @return RedirectResponse
     */
    public function create(UserFormRequest $request, UserMaker $maker): RedirectResponse
    {
        $validated = $request->validated();

        $user = $maker->criarUser(
            $validated['name'],
            $validated['email'],
            $validated['password'],
            ($request->admin) ? true : false,
        );

        $mensagem = 'Usuário ' . $user->name . ' <' . $user->email . '> foi criado!';

        return redirect()->back()
            ->with('success', $mensagem);
    }

    /**
     * Altera as informações do usuário.
     *
     * @param UserFormRequest $request
     * @return RedirectResponse
     */
    public function store(UserFormRequest $request, UserUpdater $updater): RedirectResponse
    {
        $validated = $request->validated();

        $user = $updater->atualizarUser($request->id, $validated);

        $mensagem = 'Os dados foram atualizados:\n';
        $mensagem .= '> Nome: ' . $user->name . '\n';
        $mensagem .= '> Email: ' . $user->email . '\n';

        return redirect()->back()
            ->with('success', $mensagem);
    }

    /**
     * Excluí um usuário.
     *
     * @param UserFormRequest $request
     * @return RedirectResponse
     */
    public function destroy(UserFormRequest $request, UserDestroyer $destroyer): RedirectResponse
    {
        $nome = $destroyer->removerUser($request->id);

        $mensagem = 'O usuário ' . $nome . ' foi excluído.';

        return redirect()->back()
            ->with('success', $mensagem);
    }

    /**
     * Redefine a senha do usuário.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function reset(Request $request): RedirectResponse
    {
        $novaSenha = 'teste';
        $user = User::find($request->id);
        $user->redefinirSenha($novaSenha);

        $mensagem = 'A senha do usuário ' . $user->name . ' <' . $user->email . '> foi alterada para:\n';
        $mensagem .= '> ' . $novaSenha;

        return redirect()->back()
            ->with('success', $mensagem);
    }

    /**
     * Altera a senha do usuário.
     *
     * @param UserFormRequest $request
     * @return RedirectResponse
     */
    public function passUpdate(UserFormRequest $request): RedirectResponse
    {
        try {
            $user = User::find($request->id);
            $user->alterarSenha($request->password, $request->confirmaPassword);

            $mensagem = 'A senha foi alterada.';

            return redirect()->back()
                ->with('success', $mensagem);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage(), 'user');
        }
    }
}
