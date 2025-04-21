<?php

use Illuminate\Support\Facades\Route;

// Route::get('/history.index', function () {
//     return view('index');
// });

use App\Http\Controllers\HistoryController;

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');

