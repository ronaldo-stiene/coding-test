<?php

namespace App\Http\Controllers;

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
        if ($request->id) {
            $fornecedor = Fornecedor::find($request->id);
            return view('index', compact('fornecedor'));
        }

        $fornecedores = Fornecedor::all();
        return view('index', compact('fornecedores'));
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
        $updater->atualizarFornecedor($request->id, $validated);
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
        $nome = $destroyer->removerFornecedor($request->id);
        return redirect()->route('home');
    }
}
