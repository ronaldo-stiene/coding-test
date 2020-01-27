<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Http\Services\ProdutoDestroyer;
use App\Http\Services\ProdutoMaker;
use App\Http\Services\ProdutoUpdater;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * -----------------------------------------------------------------------
 * Controller de Produtos
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para as operações com
 * os produtos.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class ProdutoController extends Controller
{
    /**
     * Controla a listagem de produtos.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->id) {
            $produto = Produto::find($request->id);
            return view('index', compact('produto'));
        }

        $produtos = Produto::all();
        return view('index', compact('produtos'));
    }

    /**
     * Controla a criação de novos produtos.
     *
     * @param ProdutoFormRequest $request
     * @param ProdutoMaker $maker
     * @return RedirectResponse
     */
    public function create(ProdutoFormRequest $request, ProdutoMaker $maker): RedirectResponse
    {
        $validated = $request->validated();
        $produto = $maker->criarProduto(
            $validated['nome'],
            $validated['imagem'],
            $validated['fornecedor'],
        );

        return redirect()->route('home');
    }

    /**
     * Controla a alteração de produtos.
     *
     * @param ProdutoFormRequest $request
     * @param ProdutoUpdater $updater
     * @return RedirectResponse
     */
    public function store(ProdutoFormRequest $request, ProdutoUpdater $updater): RedirectResponse
    {
        $validated = $request->validated();
        $updater->atualizarProduto($request->id, $validated);
        return redirect()->route('home');
    }

    /**
     * Controla a exclusão de produtos.
     *
     * @param Request $request
     * @param ProdutoDestroyer $destroyer
     * @return RedirectResponse
     */
    public function destroy(Request $request, ProdutoDestroyer $destroyer): RedirectResponse
    {
        $nome = $destroyer->removerProduto($request->id);
        return redirect()->route('home');
    }
}
