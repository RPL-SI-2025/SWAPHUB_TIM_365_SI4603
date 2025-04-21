<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HistoryController;

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registration', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store']);

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang/{id_barang}', [BarangController::class, 'show'])->name('barang.show');

    Route::get('/penukaran/{id_barang}/create', [PenukaranController::class, 'create'])->name('penukaran.create');
    Route::post('/penukaran/{id_barang}', [PenukaranController::class, 'store'])->name('penukaran.store');
    Route::get('/penukaran', [PenukaranController::class, 'index'])->name('penukaran.index');
    Route::post('/penukaran/{id_penukaran}/confirm', [PenukaranController::class, 'confirm'])->name('penukaran.confirm');
    Route::post('/penukaran/{id_penukaran}/reject', [PenukaranController::class, 'reject'])->name('penukaran.reject');
    Route::post('notification/read/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.read');

    // Route History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');
});