<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpendingController;

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

Route::get('/depenses', [SpendingController::class, 'display'])->name('spendings.display');
Route::post('/depenses', [SpendingController::class, 'store'])->name('spendings.store');