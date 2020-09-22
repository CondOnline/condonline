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
    'middleware' => [
        'auth', 'userBlocked'
    ]
], function (){

    /*
     * Rotas Morador
     */
    Route::group([
        'as' => 'user.',
        'prefix' => 'user',
        'namespace' => 'User',
    ], function (){

        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/show', 'UserController@show')->name('show');
        Route::get('photo/{photo}', 'UserController@photo')->name('photo');
        Route::post('photo/', 'UserController@updatePhoto')->name('update.photo');
        Route::get('remove/photo/', 'UserController@removePhoto')->name('remove.photo');
        Route::patch('alter/password', 'UserController@alterPassword')->name('alter.password');
        Route::get('clear/notifications', 'HomeController@clearNotifications')->name('clear.notifications');

        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        Route::get('/orders/{order}/{image}', 'OrderController@image')->name('orders.image');

    });

    /*
     * Rotas Admin
     */
    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => [
            'access.control.list'
        ]
    ], function (){

        Route::get('/', 'HomeController@index')->name('index');

        Route::resource('users', 'UserController'); // Rotas Resource Usuários
        Route::get('users/photo/{user}/{photo}', 'UserController@photo')->name('users.photo');
        Route::get('users/remove/photo/{user}', 'UserController@removePhoto')->name('users.remove.photo');

        Route::resource('groups', 'GroupController'); // Rotas Resource Grupo de Usuários
        Route::resource('userAccessGroups', 'UserAccessGroupController'); // Rotas Resource Grupo de Acesso do Usuário
        Route::resource('streets', 'StreetController'); // Rotas Resource Ruas
        Route::post('residences/users', 'ResidenceController@users')->name('residences.users'); // Usuário de uma residência
        Route::resource('residences', 'ResidenceController'); // Rotas Resource Residências

        Route::resource('orders', 'OrderController'); // Rotas Resource Encomendas
        Route::get('orders/image/{order}', 'OrderController@image')->name('orders.image');
        Route::get('orders/remove/image/{order}', 'OrderController@removeImage')->name('orders.remove.image');

    });

});


