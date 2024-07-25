<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;


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

Route::group(['prefix' => ''], function(){
    Route::group(['middleware' => 'guest'], function(){
                Route::get('/', [AuthController::class, 'login'])->name('login');
                Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
                Route::get('/register', [AuthController::class, 'register'])->name('register');
                Route::post('/storeregister', [AuthController::class, 'storeregister'])->name('storeregister');
            });
    Route::group(['middleware' => 'auth'], function(){

        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/transaction', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transaction/create', [TransactionController::class, 'tra_create'])->name('transactions.create');
        Route::post('/store', [TransactionController::class, 'tra_store'])->name('transactions.store');
        Route::get('/transaction/{id}/edit', [TransactionController::class, 'tra_edit'])->name('transactions.edit');
        Route::put('/transaction/{id}', [TransactionController::class, 'tra_update'])->name('transactions.update');
        Route::delete('/transaction/{id}', [TransactionController::class, 'tra_destroy'])->name('transactions.destroy');
        Route::get('transactions/monthly-report', [TransactionController::class, 'monthlyReport'])->name('transactions.monthlyReport');

        
        Route::get('/settings', [BudgetController::class, 'edit'])->name('settings.edit');
        Route::post('/settings/update', [BudgetController::class, 'update'])->name('settings.update');



    });


});

