<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ola', 'API\ProdutosController@teste');

//produtos
Route::post('/create-produtos','API\ProdutosController@create');
Route::delete('/delete-produtos','API\ProdutosController@delete');
Route::get('/listar-produtos','API\ProdutosController@listProdutos');

//categorias
Route::post('/create-categorias','API\CategoriasController@create');
Route::delete('/delete-categorias','API\CategoriasController@delete');
Route::get('/listar-categorias','API\CategoriasController@listCategorias');

//kits
Route::post('/create-kits','API\KitsController@create');
Route::post('/add-produto-kit','API\KitsController@addProduto');
Route::delete('/remove-produto-kit','API\KitsController@removeProduto');
Route::post('/list-all-kits','API\KitsController@listAllKits');
Route::post('/list-one-kit','API\KitsController@listOneKit');


