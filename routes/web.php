<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;

// Route::get('/', 'HomeController@index')->name('home');

// Route::get('/{id}/atualizar', function (Request $request) {
//     $fornecedor = Fornecedor::find($request->id);
//     return view('fornecedor.atualizar', compact('fornecedor'));
// });
// Route::get('/criar', function () {
//     return view("fornecedor.criar");
// });
// Route::post('/criar', 'FornecedorController@create');
// Route::get('/{id}', 'FornecedorController@index');
// Route::post('/{id}', 'FornecedorController@store');
// Route::delete('/{id}', 'FornecedorController@destroy');

// Route::get('/produto/{id}/atualizar', function (Request $request) {
//     $produto = Produto::find($request->id);
//     $fornecedores = Fornecedor::all();
//     return view('produto.atualizar', compact('produto', 'fornecedores'));
// });
// Route::get('/produto/criar', function() {
//     $fornecedores = Fornecedor::all();
//     return view("produto.criar", compact('fornecedores'));
// });
// Route::post('/produto/criar', 'ProdutoController@create');
// Route::post('/produto/{id}', 'ProdutoController@store');
// Route::post('/produto/{id}/comprar', 'EstoqueController@store');
// Route::post('/produto/{id}/vender', 'EstoqueController@store');
// Route::delete('/produto/{id}', 'ProdutoController@destroy');

/**
 * Rota da página inicial.
 */
Route::get('/', 'HomeController@index')->name('home');

/**
 * Rota para o login e logout.
 */
Route::post('/login', 'UserControler@login')->name('login');
Route::get('/logout', 'UserControler@logout')->name('logout');

/**
 * Rota para alteração de dados do usuário.
 */
Route::middleware('auth')->prefix('user')->group(function () {

    Route::post('create', 'UserControler@create')->name('criar-user');
    Route::post('', 'UserControler@store')->name('user');
    Route::delete('', 'UserControler@delete')->name('user');

});

/**
 * Rota para o estoque
 */
Route::get('/estoque', 'EstoqueController@index')->name('estoque');

/**
 * Rota para os fornecedores
 */
Route::get('/fornecedores', 'FornecedorController@index')->name('fornecedores');

Route::prefix('fornecedor')->group(function () {
    Route::get('{id}', 'FornecedorController@show')->name('fornecedor');

    Route::middleware('auth')->group(function () {
        Route::post('criar', 'FornecedorController@create')->name('criar-fornecedor');
        Route::post('{id}', 'FornecedorController@store')->name('fornecedor');
        Route::delete('{id}', 'FornecedorController@destroy')->name('fornecedor');
    });
});

/**
 * Rota para os produtos
 */
Route::get('/produtos', 'ProdutoController@index')->name('produtos');

Route::prefix('produto')->group( function () {
    Route::get('{id}', 'ProdutoController@show')->name('produto');

    Route::middleware('auth')->group( function () {
        Route::post('criar', 'ProdutoController@create')->name('criar-produto');
        Route::post('{id}', 'ProdutoController@store')->name('produto');
        Route::delete('{id}', 'ProdutoController@destroy')->name('produto');
        Route::post('{id}/compra', 'ProdutoController@compra')->name('comprar-produto');
        Route::post('{id}/venda', 'ProdutoController@venda')->name('vender-produto');
    });
});

