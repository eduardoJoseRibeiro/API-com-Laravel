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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::get('/produtos', 'ProdutoController@index'); //Lista
    Route::post('/produtos', 'ProdutoController@store'); //Cadastra
    Route::put('/produtos/{produto}', 'ProdutoController@update'); //Update
    Route::get('/produtos/{produto}', 'ProdutoController@show'); //Mostra Produto Unico
    Route::delete('/produtos/{produto}', 'ProdutoController@destroy'); //Delete
});
