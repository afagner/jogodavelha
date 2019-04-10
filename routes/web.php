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

/*Route::get('/', function () {
    return view('jogodavelha/index');
});*/

Route::get('/','JogoDaVelhaController@index');
Route::post('salva-usuario','JogoDaVelhaController@salvaUser');
Route::post('efetua-jogada','JogoDaVelhaController@efetuaJogada');
Route::post('novo-jogo','JogoDaVelhaController@novoJogo');
