<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');

Route::prefix('contacts')->group(function () {
    // Route::post('/', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/{id}', [ContactController::class, 'show'])->name('contacts.show');
    // Route::put('/{id}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
});
