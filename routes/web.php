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

Route::group(['middleware]' => 'web'], function(){
    Route::get('/', function () {
        return view('welcome');
    });
    
    Auth::routes();
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
});

Route::get('/clientes', 'App\Http\Controllers\ClienteController@index')->middleware('auth');
Route::get('/clientes/new', 'App\Http\Controllers\ClienteController@new')->middleware('auth');
Route::post('/clientes/add', 'App\Http\Controllers\ClienteController@add')->middleware('auth');
Route::get('/clientes/{id}/edit', 'App\Http\Controllers\ClienteController@edit')->middleware('auth');
Route::post('/clientes/update/{id}', 'App\Http\Controllers\ClienteController@update')->middleware('auth');
Route::delete('/clientes/delete/{id}', 'App\Http\Controllers\ClienteController@delete')->middleware('auth');

Route::get('/financiamentos', 'App\Http\Controllers\FinanciamentoController@index')->middleware('auth');
Route::get('/financiamentos/new', 'App\Http\Controllers\FinanciamentoController@new')->middleware('auth');
Route::post('/financiamentos/add', 'App\Http\Controllers\FinanciamentoController@add')->middleware('auth');
Route::get('/financiamentos/{id}/edit', 'App\Http\Controllers\FinanciamentoController@edit')->middleware('auth');
Route::post('/financiamentos/update/{id}', 'App\Http\Controllers\FinanciamentoController@update')->middleware('auth');
Route::delete('/financiamentos/delete/{id}', 'App\Http\Controllers\FinanciamentoController@delete')->middleware('auth');

Route::get('/financiamentos/busca_cliente', 'App\Http\Controllers\FinanciamentoController@busca_cliente' )->name('financiamento.busca_cliente');

