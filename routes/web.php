<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LaporanPenipuanController;
use App\Http\Controllers\RatingWebsiteController;
use App\Http\Controllers\RatingPenggunaController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\RekomendasiBarangController;

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

    // Route Laporan Penipuan
    Route::resource('laporan_penipuan', LaporanPenipuanController::class);
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard.index');

    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);

    // Route untuk Admin mengelola status Laporan Penipuan
    Route::post('laporan_penipuan/{id}/status', [LaporanPenipuanController::class, 'updateStatus'])->name('laporan_penipuan.updateStatus');

    // Route untuk Admin mengelola Rating dan Review
    Route::get('/rating', [ReplyController::class, 'index'])->name('admin.rating.index');
    Route::get('/rating/{id}/reply', [ReplyController::class, 'replyForm'])->name('admin.rating.replyForm');
    Route::post('/rating/{id}/reply', [ReplyController::class, 'reply'])->name('admin.rating.reply');
});

// Rating routes - memerlukan authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/rating', [RatingWebsiteController::class, 'index'])->name('rating.index');
    Route::post('/rating', [RatingWebsiteController::class, 'store'])->name('rating.store');
    Route::put('/rating/{id}', [RatingWebsiteController::class, 'update'])->name('rating.update');
    Route::delete('/rating/{id}', [RatingWebsiteController::class, 'destroy'])->name('rating.destroy');
    Route::get('/rating/{id}/edit', [RatingWebsiteController::class, 'edit'])->name('rating.edit');

    // Route untuk fitur rating pengguna
    Route::get('/rating-user', [RatingPenggunaController::class, 'index'])->name('rating_pengguna.index');
    Route::get('/rating-user/create', [RatingPenggunaController::class, 'create'])->name('rating_pengguna.create');
    Route::post('/rating-user', [RatingPenggunaController::class, 'store'])->name('rating_pengguna.store');
    Route::put('/rating-user/{id}', [RatingPenggunaController::class, 'update'])->name('rating_pengguna.update');
    Route::delete('/rating-user/{id}', [RatingPenggunaController::class, 'destroy'])->name('rating_pengguna.destroy');
    Route::get('/rating-user/{id}/edit', [RatingPenggunaController::class, 'edit'])->name('rating_pengguna.edit');

    // Route untuk fitur rekomendasi
    Route::get('rekomendasi', [RekomendasiBarangController::class, 'index'])->name('admin.rekomendasi.index');
    Route::post('rekomendasi', [RekomendasiBarangController::class, 'store'])->name('admin.rekomendasi.store');
    Route::delete('rekomendasi/{id}', [RekomendasiBarangController::class, 'destroy'])->name('admin.rekomendasi.destroy');
});
