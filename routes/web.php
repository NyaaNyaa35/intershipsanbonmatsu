<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::get('/', [ApiController::class, 'show']);
Route::get('/{category}/{name}', [ApiController::class, 'showSelectedProduct']);
Route::get('/cart', [ApiController::class, 'showCart']);
Route::post('/cart/add', [ApiController::class, 'insertCart']);

// Route::get('/{category}', [ApiController::class, 'searchProduct']);

