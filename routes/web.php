<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PelangganControlller;
use App\Http\Controllers\Stok_barangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index']);

// Pelanggan
Route::get('/pelanggan', [PelangganControlller::class, 'index'])->name('pelanggan');
Route::get('/pelanggan/create', [PelangganControlller::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/create', [PelangganControlller::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/edit', [PelangganControlller::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}', [PelangganControlller::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganControlller::class, 'destroy'])->name('pelanggan.destroy');

// TRANSAKSI
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.transaksi');
Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');

// MANAGE_USER
Route::get('/manage_user', [UserController::class, 'index'])->name('manage_user.user');

// STOK_BARANG
Route::get('/stok_barang', [Stok_barangController::class, 'index'])->name('stok_barang.barang');
Route::get('/createbarang', [Stok_barangController::class, 'createbarang'])->name('stok_barang.create');
Route::post('/createbarang', [Stok_barangController::class, 'store'])->name('stok_barang.store');
Route::get('/stok_barang/{id}', [Stok_barangController::class, 'show'])->name('stok_barang.show');
Route::get('stok_barang/{id}/edit', [Stok_barangController::class, 'edit'])->name('stok_barang.edit');
Route::put('stok_barang/{id}', [Stok_barangController::class, 'update'])->name('stok_barang.update');
Route::delete('/stok_barang/{id}', [Stok_barangController::class, 'destroy'])->name('stok_barang.destroy');


//LOGIN
Route::get('/login', [loginController::class, 'index'])->name('indekslogin.index');
