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

Route::get('/', 'FornecedorController@index')->name('home');

Route::get('/{id}/atualizar', function (Request $request) {
    $fornecedor = Fornecedor::find($request->id);
    return view('fornecedor.atualizar', compact('fornecedor'));
});
Route::get('/criar', function () {
    return view("fornecedor.criar");
});
Route::post('/criar', 'FornecedorController@create');
Route::get('/{id}', 'FornecedorController@index');
Route::post('/{id}', 'FornecedorController@store');
Route::delete('/{id}', 'FornecedorController@destroy');

Route::get('/produto/{id}/atualizar', function (Request $request) {
    $produto = Produto::find($request->id);
    $fornecedores = Fornecedor::all();
    return view('produto.atualizar', compact('produto', 'fornecedores'));
});
Route::get('/produto/criar', function() {
    $fornecedores = Fornecedor::all();
    return view("produto.criar", compact('fornecedores'));
});
Route::post('/produto/criar', 'ProdutoController@create');
Route::post('/produto/{id}', 'ProdutoController@store');
Route::post('/produto/{id}/comprar', 'EstoqueController@store');
Route::post('/produto/{id}/vender', 'EstoqueController@store');
Route::delete('/produto/{id}', 'ProdutoController@destroy');
