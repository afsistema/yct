<?php


use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect('/number');
})->middleware('auth');


Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('indexCustomer');
    Route::get('create/{id}', [CustomerController::class, 'create'])->name('createCustomer');
    Route::post('create/{id}', [CustomerController::class, 'save'])->name('createCustomerSave');    
    Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('deleteCustomer');    
});

Route::prefix('login')->group(function () {
    Route::post('/', [LoginController::class, 'authenticate']);
    Route::get('/', function () {
        return view('auth/login');
    })->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});   

Route::prefix('number')->group(function () {
    Route::get('/', [NumberController::class, 'index'])->name('indexNumber');
    Route::get('create/{id}', [NumberController::class, 'create'])->name('createNumber');
    Route::post('create/{id}', [NumberController::class, 'save'])->name('createNumberSave');  
    Route::get('delete/{id}', [NumberController::class, 'delete'])->name('deleteNumber');  
    Route::get('show/{id}', [NumberController::class, 'show'])->name('showNumber');     
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('indexUser');
    Route::get('create/{id}', [UserController::class, 'create'])->name('createUser');
    Route::post('create/{id}', [UserController::class, 'save'])->name('createUserSave');  
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('deleteUser');     
});