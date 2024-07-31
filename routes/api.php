<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('api_index', [CustomerController::class, 'api_index']);
Route::get('produk_by_id/{id}', [CustomerController::class, 'api_produk_by_id']);
Route::post('add_transaksi', [TransaksiController::class, 'add']);
Route::get('callback/{id}', [TransaksiController::class, 'callback']);
