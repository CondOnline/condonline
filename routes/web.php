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

Route::get('/', function (){
    return redirect()->route('login');
})->name('index');

Auth::routes();

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'
], function (){

    Route::get('/', 'HomeController@index')->name('index');

    Route::resource('users', 'UserController'); // Rotas Resource Usuários
    Route::resource('userAccessGroups', 'UserAccessGroupController'); // Rotas Resource Grupo de Acesso do Usuário
    Route::resource('streets', 'StreetController'); // Rotas Resource Ruas
    Route::resource('residences', 'ResidenceController'); // Rotas Resource Residências

});


