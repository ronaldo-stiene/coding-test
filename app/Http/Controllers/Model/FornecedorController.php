<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Services\FornecedorMaker;
use App\Http\Services\FornecedorUpdater;
use App\Http\Services\FornecedorDestroyer;
use App\Http\Requests\FornecedorFormRequest;

/**
 * -----------------------------------------------------------------------
 * Controller de Fornecedores
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para as operações com
 * os fornecedores.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 26/01/2020
 */
class FornecedorController extends Controller
{
    /**
     * Controla a listagem de fornecedores.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $fornecedores = Fornecedor::all();

        return view('site.fornecedores', compact('fornecedores'));
    }

    /**
     * Controla a listagem de um fornecedor.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $fornecedor = Fornecedor::find($request->id);

        return view('site.fornecedor', compact('fornecedor'));
    }

    /**
     * Controla a criação de fornecedores.
     *
     * @param FornecedorFormRequest $request
     * @param FornecedorMaker $maker
     * @return RedirectResponse
     */
    public function create(FornecedorFormRequest $request, FornecedorMaker $maker): RedirectResponse
    {
        $validated = $request->validated();

        $fornecedor = $maker->criarFornecedor(
            $validated['nome'],
            $validated['telefone'],
            [
                'cep' => $validated['cep'],
                'rua' => $validated['rua'],
                'numero' => $validated['numero'],
                'complemento' => $validated['complemento'],
                'cidade' => $validated['cidade'],
                'estado' => $validated['estado']
            ]
        );

        // @todo Exibir mensagem de sucesso.

        return redirect()->route('home');
    }

    /**
     * Controla a alteração de fornecedores.
     *
     * @param FornecedorFormRequest $request
     * @param FornecedorUpdater $updater
     * @return RedirectResponse
     */
    public function store(FornecedorFormRequest $request, FornecedorUpdater $updater): RedirectResponse
    {
        $validated = $request->validated();

        $fornecedor = $updater->atualizarFornecedor($request->id, $validated);

        // @todo Exibir mensagem de sucesso.

        return redirect()->route('home');
    }

    /**
     * Controla a exclusão de fornecedores.
     *
     * @param Request $request
     * @param FornecedorDestroyer $destroyer
     * @return RedirectResponse
     */
    public function destroy(Request $request, FornecedorDestroyer $destroyer): RedirectResponse
    {
        try {

            $nome = $destroyer->removerFornecedor($request->id);

            // @todo Exibir mensagem de sucesso.

            return redirect()->route('home');

        } catch (\Exception $e) {

            return redirect()->route('home')
                ->withErrors($e->getMessage());

        }
    }
}
