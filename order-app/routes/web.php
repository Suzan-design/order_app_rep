<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware'=>'auth'], function (){
    Route::get('/settings', function () {
        return view('dashboard.settings');

    })->name('settings');

    Route::get('/users/all', [App\Http\Controllers\UserController::class , 'getUsersDatatable'])->name('users.all');
    Route::get('users', [App\Http\Controllers\UserController::class , 'index'])->name('users.index');

    Route::get('/addUser', [App\Http\Controllers\UserController::class , 'add'])->name('users.add');
    Route::post('users/add',[App\Http\Controllers\UserController::class, 'store'])->name('user.store');

    Route::get('/addOrder', [App\Http\Controllers\OrderController::class, 'add'])->name('orders.add');
    Route::post('orders/add',[App\Http\Controllers\OrderController::class, 'store'])->name('order.store');

    Route::get('/orders/all', [App\Http\Controllers\OrderController::class , 'getOrdersDatatable'])->name('orders.all');

    Route::get('/orders/pending', [App\Http\Controllers\OrderController::class , 'getPendingOrdersDatatable'])->name('orders.pending');
    Route::get('orders/allPendingOrders', [App\Http\Controllers\OrderController::class , 'redirect_to_pending_orders'])->name('orders.pendingOrders');

    Route::get('orders/supervisor', [App\Http\Controllers\OrderController::class , 'getSupervisorOrdersDatatable'])->name('orders.supervisor');
    Route::get('orders/allSupervisorOrders', [App\Http\Controllers\OrderController::class , 'redirect_to_supervisor_orders'])->name('orders.supervisorOrders');

    Route::get('orders', [App\Http\Controllers\OrderController::class , 'index'])->name('orders.index');
    Route::get('orders/{id}/editToAccept', [App\Http\Controllers\OrderController::class , 'editToAccepted'])->name('order.editToAccepted');
    Route::get('orders/{id}/editToReject', [App\Http\Controllers\OrderController::class , 'editToRejected'])->name('order.editToRejected');

    Route::post('orders/{id}/updateToReject',[App\Http\Controllers\OrderController::class, 'updateToRejected'])->name('order.updateToReject');
    Route::post('orders/{id}/updateToAccept',[App\Http\Controllers\OrderController::class, 'updateToAccepted'])->name('order.updateToAccept');

    Route::resources([
        'users'=>UserController::class,
        'orders'=>OrderController::class,
    ]);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
