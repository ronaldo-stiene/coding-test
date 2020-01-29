<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueFormRequest;
use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * -----------------------------------------------------------------------
 * Controller de Estoque
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para as operações com
 * o estoque.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 26/01/2020
 */
class EstoqueController extends Controller
{
    /**
     * Retorna a view para a visualização do estoque.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $produtos = Produto::paginate(15);
        $visualizacao = ($request->view) ? $request->view : 'detalhes';
        return view('site.estoque', compact('produtos', 'visualizacao'));
    }
}
