<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [TicketController::class, 'homepage'])->name('home');

Route::get('/ticket/{name}', [TicketController::class, 'ticket'])->name('event');

// place order
Route::post('payment', [OrderController::class, 'place_order'])->name('payment');

Route::get('/process', [OrderController::class, 'process'])->name('process');
