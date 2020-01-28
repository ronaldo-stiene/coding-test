<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * -----------------------------------------------------------------------
 * Controller da página ínicial
 * -----------------------------------------------------------------------
 * 
 * Esta classe contém os métodos controladores para a página ínicial.
 * 
 * @author Ronaldo Stiene <rstiene27@gmail.com>
 * @since 27/01/2020
 */
class HomeController extends Controller
{
    /**
     * Retorna a view da página ínicial.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('home');
    }
}