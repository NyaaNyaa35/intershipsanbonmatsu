<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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
    return Redirect::to('/');
});

// Main Page Section
Route::get('/', [MainController::class, 'show']);
Route::get('/Beer/{category}/{name}', [MainController::class, 'showSelectedProduct']);

Route::get('/Product', [MainController::class, 'searchProduct']);

// Cart Section
Route::get('/cart', [MainController::class, 'showCart']);
Route::post('/cart/add', [MainController::class, 'insertCart']);
Route::delete('/cart/delete/{productName}', [MainController::class, 'deleteCart']);

// Checkout Section
Route::get('/cart/checkout', [MainController::class, 'showCheckout']);
Route::delete('/cart/checkout/delete', [MainController::class, 'deleteCheckout']);
Route::get('/success', [MainController::class, 'showSuccess']);
Route::get('/failed', [MainController::class, 'showFailed']);

Route::post('/cart/checkout/add', [MainController::class, 'insertCheckout']);


