<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::get('/',[DashboardController::class, 'index']);
Route::get('/dashboard_kanan',[DashboardController::class, 'dashboard_kanan']);

// TRANSAKSI
Route::get('/index', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');

// MANAGE_USER
Route::get('/manage_user', [UserController::class, 'index'])->name('manage_user.user');