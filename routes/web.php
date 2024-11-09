<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PelangganControlller;
use App\Http\Controllers\Stok_barangController;
use App\Http\Controllers\UserController;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index']);

// Pelanggan
Route::get('/pelanggan', [PelangganControlller::class, 'index'])->name('pelanggan');
Route::get('/pelanggan/create', [PelangganControlller::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan/create', [PelangganControlller::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}/edit', [PelangganControlller::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}', [PelangganControlller::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganControlller::class, 'destroy'])->name('pelanggan.destroy');

// Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori/create', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


// INVOICE  
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');
Route::post('/generate-invoice-number', [InvoiceController::class, 'generateInvoiceNumber']);
Route::get('/get-alamat-pelanggan/{id}', function ($id) {
    $pelanggan = Pelanggan::find($id);
    return response()->json(['alamat' =>  $pelanggan->alamat]);
});
Route::get('/get-harga-item/{id}', [InvoiceController::class, 'getHargaItem']);
Route::get('/invoice/payment/{id}', [InvoiceController::class, 'payment'])->name('invoice.payment');


// MANAGE_USER
Route::get('/manage_user', [UserController::class, 'index'])->name('manage_user.user');

// STOK_BARANG
Route::get('/stok_barang', [Stok_barangController::class, 'index'])->name('stok_barang.barang');
Route::get('/stok_barang/add_item', [Stok_barangController::class, 'addItem'])->name('stok_barang.addItem');
Route::get('/stok_barang/add_stok', [Stok_barangController::class, 'addStok'])->name('stok_barang.addStok');
Route::get('/createbarang', [Stok_barangController::class, 'createbarang'])->name('stok_barang.create');
Route::post('/createbarang', [Stok_barangController::class, 'store'])->name('stok_barang.store');
Route::get('/stok_barang/{id}', [Stok_barangController::class, 'show'])->name('stok_barang.show');
Route::get('stok_barang/{id}/edit', [Stok_barangController::class, 'edit'])->name('stok_barang.edit');
Route::put('stok_barang/{id}', [Stok_barangController::class, 'update'])->name('stok_barang.update');
Route::delete('/stok_barang/{id}', [Stok_barangController::class, 'destroy'])->name('stok_barang.destroy');


//LOGIN
Route::get('/login', [loginController::class, 'index'])->name('indekslogin.index');
