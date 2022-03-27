<?php

use App\Http\Controllers\ApiBarangKeluarController;
use App\Http\Controllers\ApiBarangMasukController;
use App\Http\Controllers\ApiCustomerController;
use App\Http\Controllers\ApiSupplierController;
use App\Http\Controllers\API\ApiController;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('supplier', ApiSupplierController::class);
Route::resource('customer', ApiCustomerController::class);
Route::resource('barang-masuk', ApiBarangMasukController::class);
Route::resource('barang-keluar', ApiBarangKeluarController::class);
Route::get('supplier1', [ApiController::class, 'supplier']);
Route::get('customer1', [ApiController::class, 'customer']);
Route::get('barang-masuk1', [ApiController::class, 'barang_masuk']);
Route::get('barang-keluar1', [ApiController::class, 'barang_keluar']);
