<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth') // Prefixed with auth middleware
    ->name('admin.') // Route names will start with 'admin.'
    ->group(function () {
        Route::get('tickets/filter', [TicketController::class, 'filter'])->name('tickets.filter');
        Route::resource('tickets', TicketController::class);
    });

require __DIR__ . '/auth.php';
