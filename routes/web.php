<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
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


Route::get('/', [CustomerController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/cek_login', [LoginController::class, 'cek_login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('user_edit', [UserController::class, 'update'])->name('user_edit');
Route::post('user_tambah', [UserController::class, 'store'])->name('user_tambah');
Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/tambah', [ProdukController::class, 'tambah']);
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
Route::get('/produk/aktif/{id}', [ProdukController::class, 'aktif']);
Route::get('/produk/nonaktif/{id}', [ProdukController::class, 'nonaktif']);
Route::post('produk_tambah', [ProdukController::class, 'store'])->name('produk_tambah');
Route::post('produk_edit', [ProdukController::class, 'update'])->name('produk_edit');
Route::get('/produk/destroy/{id}', [ProdukController::class, 'destroy'])->name('produk_destroy');
Route::get('/transaksi', [TransaksiController::class, 'index']);
