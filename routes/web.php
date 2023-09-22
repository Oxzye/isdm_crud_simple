<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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
    return view('auth.login');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware(Authenticate::class);
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware(Authenticate::class);
Route::get('products/create', [ProductController::class, 'create'])->name('products.create')->middleware(Authenticate::class);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware(Authenticate::class);
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware(Authenticate::class);
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(Authenticate::class);
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware(Authenticate::class);

Auth::routes();

Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('home');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);