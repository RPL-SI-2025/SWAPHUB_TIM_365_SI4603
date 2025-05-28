<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Barang;

// Landing page
Route::get('/', function () {
    $barang = Barang::where('status_barang', 'tersedia')->latest()->limit(10)->get();
    return view('landing', compact('barang'));
})->name('landing');

Route::middleware('guest')->group(function () {
    // Registration routes
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration');

    // Login routes
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang/filter', [BarangController::class, 'filter'])->name('barang.filter');
    Route::get('/barang/{id_barang}', [BarangController::class, 'show'])->name('barang.show');

    Route::get('/penukaran/{id_barang}/create', [PenukaranController::class, 'create'])->name('penukaran.create');
    Route::post('/penukaran/{id_barang}', [PenukaranController::class, 'store'])->name('penukaran.store');
    Route::get('/penukaran', [PenukaranController::class, 'index'])->name('penukaran.index');
    Route::post('/penukaran/{id_penukaran}/confirm', [PenukaranController::class, 'confirm'])->name('penukaran.confirm');
    Route::post('/penukaran/{id_penukaran}/reject', [PenukaranController::class, 'reject'])->name('penukaran.reject');

    // Route History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');
    Route::get('/history/{id_history}', [HistoryController::class, 'show'])->name('history.show');
    Route::get('/penukaran/{id}/detail', [PenukaranController::class, 'detail'])->name('penukaran.detail');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
    Route::post('/notifikasi/mark-all-as-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.markAllAsRead');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard.index');

    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);
});
