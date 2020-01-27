<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueFormRequest;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;

/**
 * -----------------------------------------------------------------------
 * Controller de Estoque
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para as operações com
 * o estoque.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 */
class EstoqueController extends Controller
{
    /**
     * Controla a compra e venda de produtos.
     *
     * @param EstoqueFormRequest $request
     * @return RedirectResponse
     */
    public function store(EstoqueFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $produto = Produto::find($request->id);
        if (isset($validated['compra'])) {
            $produto->quantidade = $produto->quantidade + $validated['compra'];
        }
        if (isset($validated['venda'])) {
            $produto->quantidade -= $validated['venda'];
        }
        $produto->save();
        return redirect()->route('home');
    }
}
