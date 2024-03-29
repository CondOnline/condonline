<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\User\HomeController as UserHomeController;
use \App\Http\Controllers\User\UserController as UserUserController;
use \App\Http\Controllers\User\OrderController as UserOrderController;
use \App\Http\Controllers\User\DocumentController as UserDocumentController;
use \App\Http\Controllers\User\CircularController as UserCircularController;
use App\Http\Controllers\User\CircularArchiveController as UserCircularArchiveController;

use \App\Http\Controllers\Admin\HomeController as AdminHomeController;
use \App\Http\Controllers\Admin\UserController as AdminUserController;
use \App\Http\Controllers\Admin\OrderController as AdminOrderController;
use \App\Http\Controllers\Admin\CircularController as AdminCircularController;
use \App\Http\Controllers\Admin\CircularArchiveController as AdminCircularArchiveController;
use \App\Http\Controllers\Admin\GroupController as AdminGroupController;
use \App\Http\Controllers\Admin\ResidenceController as AdminResidenceController;
use \App\Http\Controllers\Admin\StreetController as AdminStreetController;
use \App\Http\Controllers\Admin\UserAccessGroupController as AdminUserAccessGroupController;
use \App\Http\Controllers\Admin\DocumentController as AdminDocumentController;

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
Route::redirect('/', '/login')->name('index');

Route::group([
    'middleware' => [
        'auth', 'userBlocked'
    ]
], function (){

    Route::get('/home', function (){
        if (Auth::user()->dweller)
            return redirect()->route('user.index');

        return redirect()->route('admin.index');
    })->name('home');

    /*
     * Rotas Morador
     */
    Route::group([
        'as' => 'user.',
        'prefix' => 'user',
    ], function (){

        Route::get('/', [UserHomeController::class, 'index'])->name('index');
        Route::get('/show', [UserUserController::class, 'show'])->name('show');
        Route::get('photo/{user}', [UserUserController::class, 'photo'])->name('photo');
        Route::post('photo/', [UserUserController::class, 'updatePhoto'])->name('update.photo');
        Route::get('remove/photo/', [UserUserController::class, 'removePhoto'])->name('remove.photo');
        Route::patch('alter/password', [UserUserController::class, 'alterPassword'])->name('alter.password');
        Route::get('clear/notifications', [UserHomeController::class, 'clearNotifications'])->name('clear.notifications');
        Route::get('darkmode', [UserUserController::class, 'darkMode'])->name('dark.mode');

        Route::get('/documents', [UserDocumentController::class, 'index'])->name('documents.index');
        Route::get('/documents/{document}/{title}', [UserDocumentController::class, 'show'])->name('documents.show');

        Route::get('circular/file/{file}', [UserCircularController::class, 'fileGet'])->name('circular.file');

        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{order}/{image}', [UserOrderController::class, 'image'])->name('orders.image');

        Route::post('/logoutOtherDevices', [UserUserController::class, 'logoutOtherDevices'])->name('logoutOtherDevices');
});

    /*
     * Rotas Admin
     */
    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin',
        'middleware' => [
            'access.control.list'
        ]
    ], function (){

        Route::get('/', [AdminHomeController::class, 'index'])->name('index');

        Route::resource('users', AdminUserController::class); // Rotas Resource Usuários
        Route::get('users/photo/{user}/{photo}', [AdminUserController::class, 'photo'])->name('users.photo');
        Route::get('users/remove/photo/{user}', [AdminUserController::class, 'removePhoto'])->name('users.remove.photo');

        Route::resource('groups', AdminGroupController::class); // Rotas Resource Grupo de Usuários
        Route::resource('userAccessGroups', AdminUserAccessGroupController::class); // Rotas Resource Grupo de Acesso do Usuário
        Route::resource('streets', AdminStreetController::class); // Rotas Resource Ruas

        Route::resource('circulars', AdminCircularController::class); // Rotas Resource Circulares
        Route::post('circulars/archive/{circular}/', [AdminCircularArchiveController::class, 'store'])->name('circulars.archive');
        Route::delete('circulars/archive/{circularArchive}/destroy', [AdminCircularArchiveController::class, 'destroy'])->name('circulars.archive.destroy');
        Route::get('circulars/{circularArchive}/{circularArchiveName}', [UserCircularArchiveController::class, 'show'])->name('circulars.archive.show');

        Route::post('residences/users', [AdminResidenceController::class, 'users'])->name('residences.users'); // Usuário de uma residência
        Route::resource('residences', AdminResidenceController::class); // Rotas Resource Residências

        Route::resource('orders', AdminOrderController::class); // Rotas Resource Encomendas
        Route::get('orders/image/{order}/{image}', [AdminOrderController::class, 'image'])->name('orders.image');
        Route::get('orders/remove/image/{order}', [AdminOrderController::class, 'removeImage'])->name('orders.remove.image');

        Route::resource('documents', AdminDocumentController::class)->except(['index', 'show']);

    });

});


