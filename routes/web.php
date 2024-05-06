<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/emails', [DashboardController::class, 'emails'])->middleware(['auth', 'verified'])->name('emails');
Route::get('/csv', [DashboardController::class, 'csv'])->middleware(['auth', 'verified'])->name('csv');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('client')->group(function () {
    Route::post('/insert', [ClientController::class, 'store']);
});

Route::prefix('aJax')->group(function () {
    Route::post('/makeCsv', [AjaxController::class, 'makeCsv'])->name('makeCsv');
    Route::post('/bulkMakeCsv', [AjaxController::class, 'bulkMakeCsv'])->name('bulkMakeCsv');
    Route::post('/updateClient', [AjaxController::class, 'updateClient'])->name('updateClient');
    Route::post('/bulkUpdateClient', [AjaxController::class, 'bulkUpdateClient'])->name('bulkUpdateClient');
    Route::post('/deleteClient', [AjaxController::class, 'deleteClient'])->name('deleteClient');
    Route::post('/bulkDeleteClient', [AjaxController::class, 'bulkDeleteClient'])->name('bulkDeleteClient');
});
require __DIR__ . '/auth.php';
