<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WishlistController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registration', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store']);

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
