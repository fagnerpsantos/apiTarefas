<?php

use Illuminate\Http\Request;

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

Route::post('/cadastro','UserController@registrar');
Route::group(['middleware'=>['auth:api']], function(){
    Route::get('/tarefas', 'TarefaController@index')->middleware('scope:administrador,usuario');
	Route::get('/tarefas/{id}', 'TarefaController@show')->middleware('scope:administrador,usuario');
	Route::post('/tarefas', 'TarefaController@store')->middleware('scope:administrador');
	Route::put('/tarefas/{id}', 'TarefaController@update')->middleware('scope:administrador');
	Route::delete('/tarefas/{id}', 'TarefaController@destroy')->middleware('scope:administrador');
});

