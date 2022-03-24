<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ApiSupplierController;
use App\Http\Controllers\API\ApiCustomerController;
use App\Http\Controllers\API\ApiBarangController
use App\Http\Controllers\API\ApiBarangMasukController;
use App\Http\Controllers\API\ApiBarangKeluarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('supplier', ApiSupplierController::class);
Route::resource('customer', ApiCustomerController::class);
Route::resource('barang', ApiBarangController::class);
Route::resource('barang-masuk', ApiBarangMasukController::class);
Route::resource('barang-keluar', ApiBarangKeluarController::class);
