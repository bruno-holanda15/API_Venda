<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    echo "Olá mundo!";
});

Route::get('/produtos/controle-produtos','ProdutosController@list');
Route::get('/produtos/criar-produto','ProdutosController@create');
Route::post('/produtos/criar-produto','ProdutosController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
