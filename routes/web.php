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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/offline', 'HomeController@offline')->name('offline');

Auth::routes([ 'register' => false]);

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => [
        'auth', 'access.control.list'
    ]
], function (){

    Route::get('/', 'HomeController@index')->name('index');

    Route::resource('users', 'UserController'); // Rotas Resource Usuários
    Route::get('users/photo/{user}', 'UserController@photo')->name('users.photo');
    Route::get('users/remove/photo/{user}', 'UserController@removePhoto')->name('users.remove.photo');

    Route::resource('userAccessGroups', 'UserAccessGroupController'); // Rotas Resource Grupo de Acesso do Usuário
    Route::resource('streets', 'StreetController'); // Rotas Resource Ruas
    Route::post('residences/users', 'ResidenceController@users')->name('residences.users'); // Usuário de uma residência
    Route::resource('residences', 'ResidenceController'); // Rotas Resource Residências

    Route::resource('orders', 'OrderController'); // Rotas Resource Encomendas
    Route::get('orders/image/{order}', 'OrderController@image')->name('orders.image');
    Route::get('orders/remove/image/{order}', 'OrderController@removeImage')->name('orders.remove.image');

});


