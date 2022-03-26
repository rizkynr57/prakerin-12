<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiBarangKeluarController;
use App\Http\Controllers\ApiBarangMasukController;
use App\Http\Controllers\ApiCustomerController;
use App\Http\Controllers\ApiSupplierController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('supplier', ApiSupplierController::class);
Route::resource('customer', ApiCustomerController::class);
Route::resource('barang-masuk', ApiBarangMasukController::class);
Route::resource('barang-keluar', ApiBarangKeluarController::class);
Route::resource('barang-masuk-join', [ApiController::class, 'JoinBarangMasuk']);
Route::resource('barang-keluar-join', [ApiController::class, 'JoinBarangKeluar']);

