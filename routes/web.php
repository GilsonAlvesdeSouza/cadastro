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


Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index');
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::resource('cidades', 'CidadeController');
    /*Rotas Protegidas*/
    Route::group(['middleware' => ['web','auth']], function () {
        Route::get('clientes/trashed', 'ClienteController@trashed')->name('clientes.trashed');
        Route::get('clientes/{clinte}/restore', 'ClienteController@restore')->name('clientes.restore');
        Route::delete('clientes/{clientes}/force-delete', 'ClienteController@forceDelete')->name('clientes.force-delete');
        Route::resource('clientes', 'ClienteController');
    });


});

