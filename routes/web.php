<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\RiwayatPembelianController;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/profil', function () {
    return view('profil');
})->middleware('auth')->name('profil');
// Auth bawaan Laravel
Auth::routes();

// Route yang bisa diakses semua user setelah login
Route::middleware(['auth'])->group(function () {
    // Halaman utama
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Lihat daftar barang (user & admin)
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    // Melakukan pembelian
    Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');

    // Lihat riwayat pembelian
    Route::get('/riwayat', [RiwayatPembelianController::class, 'index'])->name('riwayat.index');

    // Penjualan resource (lihat data penjualan user)
    Route::resource('penjualan', PenjualanController::class);
    Route::put('/update-alamat', [barangcontroller::class, 'updateAlamat'])->name('update-alamat');
});
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::delete('/ulasan/{ulasan}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

// Route khusus admin
Route::middleware(['auth', 'admin'])->group(function () {
    // CRUD barang
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Admin update status penjualan
});
Route::patch('/penjualan/{id}/status', [PenjualanController::class, 'updateStatus'])->name('penjualan.updateStatus');
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
});
