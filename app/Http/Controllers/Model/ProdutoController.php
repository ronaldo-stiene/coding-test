<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
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
 * @since 26/01/2020
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
        $produtos = Produto::all();

        return view('site.produtos', compact('produtos'));
    }

    /**
     * Controla a listagem de um produto.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $produto = Produto::find($request->id);

        return view('site.produto', compact('produto'));
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

        // @todo Exibir mensagem de sucesso.

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

        $produto = $updater->atualizarProduto($request->id, $validated);

        // @todo Exibir mensagem de sucesso.

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

        // @todo Exibir mensagem de sucesso.

        return redirect()->route('home');
    }

    /**
     * Controla a compra de novos produtos.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function comprar(Request $request): RedirectResponse
    {
        $validated = $request->validated();

        $produto = Produto::find($request->id);
        $produto->quantidade = $produto->quantidade + $validated['compra'];
        $produto->save();

        // @todo Exibir mensagem de sucesso.

        return redirect()->route('home');
    }

    /**
     * Controla a venda de novos produtos.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function vender(Request $request): RedirectResponse
    {
        $validated = $request->validated();

        $produto = Produto::find($request->id);
        $produto->quantidade = $produto->quantidade - $validated['venda'];
        $produto->save();

        // @todo Exibir mensagem de sucesso.

        return redirect()->route('home');
    }
}
