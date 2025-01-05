<?php

use App\Http\Controllers\ArsipInvoiceController;
use App\Http\Controllers\ArsipPreOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PelangganControlller;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\Stok_barangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//LOGIN
Route::get('/', [loginController::class, 'index'])->name('login');
Route::post('/login-proses', [loginController::class, 'proses'])->name('login.proses');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show']);

    // Pelanggan
    Route::get('/pelanggan', [PelangganControlller::class, 'index'])->name('pelanggan.index');
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

    //PEKERJAAN
    Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
    Route::get('/pekerjaan/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
    Route::post('/pekerjaan/create', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
    Route::put('/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

    // STOK_BARANG
    Route::get('/stok_barang', [Stok_barangController::class, 'index'])->name('stok_barang.barang');
    Route::get('/stok_barang/add_item', [Stok_barangController::class, 'addItem'])->name('stok_barang.addItem');
    Route::get('/stok_barang/add_stok', [Stok_barangController::class, 'addStok'])->name('stok_barang.addStok');
    Route::get('/createbarang', [Stok_barangController::class, 'createbarang'])->name('stok_barang.create');
    Route::post('/createbarang', [Stok_barangController::class, 'store'])->name('stok_barang.store');
    Route::post('/createStokLama', [Stok_barangController::class, 'addStokLama'])->name('stok_barang.addStokLama');
    Route::get('/stok_barang/{id}', [Stok_barangController::class, 'show'])->name('stok_barang.show');
    Route::get('stok_barang/{id}/edit', [Stok_barangController::class, 'edit'])->name('stok_barang.edit');
    Route::put('stok_barang/{id}', [Stok_barangController::class, 'update'])->name('stok_barang.update');
    Route::delete('/stok_barang/{id}', [Stok_barangController::class, 'destroy'])->name('stok_barang.destroy');

    // INVOICE  
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/generate-invoice-number', [InvoiceController::class, 'generateInvoiceNumber']);
    Route::get('/get-alamat-pelanggan/{id}', [InvoiceController::class, 'getAlamatPelanggan']);
    Route::get('/get-harga-item/{id}', [InvoiceController::class, 'getHargaItem']);
    Route::get('/invoice/payment/{id}', [InvoiceController::class, 'payment'])->name('invoice.payment');
    Route::post('/invoice/{id}/payment', [InvoiceController::class, 'payment_store'])->name('invoice.payment.store');
    Route::get('/invoice/history-payment/{id}', [InvoiceController::class, 'history'])->name('invoice.history');
    Route::get('/invoice/history-payment/{id}/edit', [InvoiceController::class, 'editPayment'])->name('invoice.history.edit');
    Route::put('/invoice/history-payment/{id}', [InvoiceController::class, 'updatePayment'])->name('invoice.history.update');
    Route::delete('/invoice/history-payment/{id}', [InvoiceController::class, 'destroy'])->name('invoice.history.destroy');
    Route::get('/invoice/{id}/export-pdf', [InvoiceController::class, 'exportPdf'])->name('invoice.exportPdf');
    Route::post('/invoice/{id}/archive', [InvoiceController::class, 'archive'])->name('invoice.archive');

    // Arsip Invoice
    Route::get('/archive-invoice', [ArsipInvoiceController::class, 'index'])->name('archive.invoice');
    Route::post('/archive-invoice/{id}/restore', [ArsipInvoiceController::class, 'restore'])->name('archive.restore');
    Route::delete('/archive-invoice/{id}', [ArsipInvoiceController::class, 'destroy'])->name('archive.destroy');

    // PRE ORDER
    Route::get('/pre-order', [PreOrderController::class, 'index'])->name('preOrder.index');
    Route::get('/pre-order/create', [PreOrderController::class, 'create'])->name('preOrder.create');
    Route::get('/get-nama-pelanggan/{id}', [PreOrderController::class, 'getNamaPelanggan']);
    Route::get('/get-invoice-items/{id}', [PreOrderController::class, 'getInvoiceItems']);
    Route::post('/pre-order/create', [PreOrderController::class, 'store'])->name('preOrder.store');
    Route::post('/pre-order/{id}/update-status', [PreOrderController::class, 'updateStatus']);
    Route::get('/pre-order/{id}', [PreOrderController::class, 'show'])->name('preOrder.show');
    Route::delete('/pre-order/{id}', [PreOrderController::class, 'destroy'])->name('preOrder.destroy');
    Route::post('/pre-order/{id}/archive', [PreOrderController::class, 'archive'])->name('preOrder.archive');

    // Arsip pre order
    Route::get('/archive-pre-order', [ArsipPreOrderController::class, 'index'])->name('preOrderArchive.index');
    Route::post('/archive-pre-order/{id}/restore', [ArsipPreOrderController::class, 'restore'])->name('preOrderArchive.restore');
    Route::delete('archive-pre-order/{id}', [ArsipPreOrderController::class, 'destroy'])->name('preOrderArchive.destroy');

    // MANAGE_USER
    // Route::get('/manage-user', [UserController::class, 'index'])->name('manage_user.user');
    // Route::get('/manage_user/create', [UserController::class, 'create'])->name('manage_user.create');
    // Route::post('/manage_user/create', [UserController::class, 'store'])->name('manage_user.store');
    // Route::get('/manage_user/{id}/edit', [UserController::class, 'edit'])->name('manage_user.edit');
    // Route::put('/manage_user/{id}', [UserController::class, 'update'])->name('manage_user.update');
    // Route::delete('/manage_user/{id}', [UserController::class, 'destroy'])->name('manage_user.destroy');
});


Route::group(['prefix' => 'produksi', 'middleware' => ['auth', 'role:produksi'], 'as' => 'produksi.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PRE ORDER
    Route::get('/pre-order', [PreOrderController::class, 'index'])->name('preOrder.index');
    Route::get('/pre-order/create', [PreOrderController::class, 'create'])->name('preOrder.create');
    Route::get('/get-nama-pelanggan/{id}', [PreOrderController::class, 'getNamaPelanggan']);
    Route::get('/get-invoice-items/{id}', [PreOrderController::class, 'getInvoiceItems']);
    Route::post('/pre-order/create', [PreOrderController::class, 'store'])->name('preOrder.store');
    Route::post('/pre-order/{id}/update-status', [PreOrderController::class, 'updateStatus']);
    Route::get('/pre-order/{id}', [PreOrderController::class, 'show'])->name('preOrder.show');
    Route::put('/pre-order/{id}', [PreOrderController::class, 'update'])->name('preOrder.update');
    Route::delete('/pre-order/{id}', [PreOrderController::class, 'destroy'])->name('preOrder.destroy');
    Route::post('/pre-order/{id}/archive', [PreOrderController::class, 'archive'])->name('preOrder.archive');

    // Arsip pre order
    Route::get('/archive-pre-order', [ArsipPreOrderController::class, 'index'])->name('preOrderArchive.index');
    Route::post('/archive-pre-order/{id}/restore', [ArsipPreOrderController::class, 'restore'])->name('preOrderArchive.restore');
    Route::delete('archive-pre-order/{id}', [ArsipPreOrderController::class, 'destroy'])->name('preOrderArchive.destroy');
});


Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'role:manager'], 'as' => 'manager.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show']);


    // Pelanggan
    Route::get('/pelanggan', [PelangganControlller::class, 'index'])->name('pelanggan.index');
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

    //PEKERJAAN
    Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
    Route::get('/pekerjaan/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
    Route::post('/pekerjaan/create', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
    Route::put('/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

    // STOK_BARANG
    Route::get('/stok_barang', [Stok_barangController::class, 'index'])->name('stok_barang.barang');
    Route::get('/stok_barang/add_item', [Stok_barangController::class, 'addItem'])->name('stok_barang.addItem');
    Route::get('/stok_barang/add_stok', [Stok_barangController::class, 'addStok'])->name('stok_barang.addStok');
    Route::get('/createbarang', [Stok_barangController::class, 'createbarang'])->name('stok_barang.create');
    Route::post('/createbarang', [Stok_barangController::class, 'store'])->name('stok_barang.store');
    Route::post('/createStokLama', [Stok_barangController::class, 'addStokLama'])->name('stok_barang.addStokLama');
    Route::get('/stok_barang/{id}', [Stok_barangController::class, 'show'])->name('stok_barang.show');
    Route::get('stok_barang/{id}/edit', [Stok_barangController::class, 'edit'])->name('stok_barang.edit');
    Route::put('stok_barang/{id}', [Stok_barangController::class, 'update'])->name('stok_barang.update');
    Route::delete('/stok_barang/{id}', [Stok_barangController::class, 'destroy'])->name('stok_barang.destroy');

    // INVOICE  
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/generate-invoice-number', [InvoiceController::class, 'generateInvoiceNumber']);
    Route::get('/get-alamat-pelanggan/{id}', [InvoiceController::class, 'getAlamatPelanggan']);
    Route::get('/get-harga-item/{id}', [InvoiceController::class, 'getHargaItem']);
    Route::get('/invoice/payment/{id}', [InvoiceController::class, 'payment'])->name('invoice.payment');
    Route::post('/invoice/{id}/payment', [InvoiceController::class, 'payment_store'])->name('invoice.payment.store');
    Route::get('/invoice/history-payment/{id}', [InvoiceController::class, 'history'])->name('invoice.history');
    Route::get('/invoice/history-payment/{id}/edit', [InvoiceController::class, 'editPayment'])->name('invoice.history.edit');
    Route::put('/invoice/history-payment/{id}', [InvoiceController::class, 'updatePayment'])->name('invoice.history.update');
    Route::delete('/invoice/history-payment/{id}', [InvoiceController::class, 'destroy'])->name('invoice.history.destroy');
    Route::get('/invoice/{id}/export-pdf', [InvoiceController::class, 'exportPdf'])->name('invoice.exportPdf');
    Route::post('/invoice/{id}/archive', [InvoiceController::class, 'archive'])->name('invoice.archive');

    // Arsip Invoice
    Route::get('/archive-invoice', [ArsipInvoiceController::class, 'index'])->name('archive.invoice');
    Route::post('/archive-invoice/{id}/restore', [ArsipInvoiceController::class, 'restore'])->name('archive.restore');
    Route::delete('/archive-invoice/{id}', [ArsipInvoiceController::class, 'destroy'])->name('archive.destroy');

    // PRE ORDER
    Route::get('/pre-order', [PreOrderController::class, 'index'])->name('preOrder.index');
    Route::get('/pre-order/create', [PreOrderController::class, 'create'])->name('preOrder.create');
    Route::get('/get-nama-pelanggan/{id}', [PreOrderController::class, 'getNamaPelanggan']);
    Route::get('/get-invoice-items/{id}', [PreOrderController::class, 'getInvoiceItems']);
    Route::post('/pre-order/create', [PreOrderController::class, 'store'])->name('preOrder.store');
    Route::post('/pre-order/{id}/update-status', [PreOrderController::class, 'updateStatus']);
    Route::get('/pre-order/{id}', [PreOrderController::class, 'show'])->name('preOrder.show');
    Route::delete('/pre-order/{id}', [PreOrderController::class, 'destroy'])->name('preOrder.destroy');
    Route::post('/pre-order/{id}/archive', [PreOrderController::class, 'archive'])->name('preOrder.archive');

    // Arsip pre order
    Route::get('/archive-pre-order', [ArsipPreOrderController::class, 'index'])->name('preOrderArchive.index');
    Route::post('/archive-pre-order/{id}/restore', [ArsipPreOrderController::class, 'restore'])->name('preOrderArchive.restore');
    Route::delete('archive-pre-order/{id}', [ArsipPreOrderController::class, 'destroy'])->name('preOrderArchive.destroy');

    // MANAGE_USER
    Route::get('/manage-user', [UserController::class, 'index'])->name('manage_user.user');
    Route::get('/manage_user/create', [UserController::class, 'create'])->name('manage_user.create');
    Route::post('/manage_user/create', [UserController::class, 'store'])->name('manage_user.store');
    Route::get('/manage_user/{id}/edit', [UserController::class, 'edit'])->name('manage_user.edit');
    Route::put('/manage_user/{id}', [UserController::class, 'update'])->name('manage_user.update');
    Route::delete('/manage_user/{id}', [UserController::class, 'destroy'])->name('manage_user.destroy');
});


Route::group(['prefix' => 'produksi', 'middleware' => ['auth', 'role:produksi'], 'as' => 'produksi.'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PRE ORDER
    Route::get('/pre-order', [PreOrderController::class, 'index'])->name('preOrder.index');
    Route::get('/pre-order/create', [PreOrderController::class, 'create'])->name('preOrder.create');
    Route::get('/get-nama-pelanggan/{id}', [PreOrderController::class, 'getNamaPelanggan']);
    Route::get('/get-invoice-items/{id}', [PreOrderController::class, 'getInvoiceItems']);
    Route::post('/pre-order/create', [PreOrderController::class, 'store'])->name('preOrder.store');
    Route::post('/pre-order/{id}/update-status', [PreOrderController::class, 'updateStatus']);
    Route::get('/pre-order/{id}', [PreOrderController::class, 'show'])->name('preOrder.show');
    Route::put('/pre-order/{id}', [PreOrderController::class, 'update'])->name('preOrder.update');
    Route::delete('/pre-order/{id}', [PreOrderController::class, 'destroy'])->name('preOrder.destroy');
    Route::post('/pre-order/{id}/archive', [PreOrderController::class, 'archive'])->name('preOrder.archive');

    // Arsip pre order
    Route::get('/archive-pre-order', [ArsipPreOrderController::class, 'index'])->name('preOrderArchive.index');
    Route::post('/archive-pre-order/{id}/restore', [ArsipPreOrderController::class, 'restore'])->name('preOrderArchive.restore');
    Route::delete('archive-pre-order/{id}', [ArsipPreOrderController::class, 'destroy'])->name('preOrderArchive.destroy');
});
