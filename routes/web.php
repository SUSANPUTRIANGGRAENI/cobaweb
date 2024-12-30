<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
    Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');

    Route::prefix('/transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::get('/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        Route::put('/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
        Route::delete('/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    });

    Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/kasir-transaksi', [KasirController::class, 'index'])->name('kasir-transaksi.index');
    Route::post('/kasir-transaksi', [KasirController::class, 'store'])->name('kasir-transaksi.store');
    Route::get('/kasir-transaksi', [TransaksiController::class]);

});

// Route::get('/kasir-transaksi', function () {
//     dd('Rute berhasil dipanggil');
// });

require __DIR__ . '/auth.php';
