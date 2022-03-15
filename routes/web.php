<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

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

// Route::get('/{any}', [SpaControler::class, 'index'])->where('any', '.*')->name('Spa.Home');

Route::redirect('/', '/login');

Auth::routes();


Route::middleware('auth')->group(function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('products', ProductController::class)->only([
        'index', 'show'
    ])->parameters(['products' => 'id']);


    Route::resource('orders', OrderController::class)->only([
        'index', 'store'
    ])->parameters(['orders' => 'id']);

    Route::resource('carts', CartController::class)->only([
        'index','store', 'destroy'
    ])->parameters(['carts' => 'id']);

});


