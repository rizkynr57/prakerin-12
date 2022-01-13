<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('profil', function () {
//     return view('profil');
// });

Auth::routes(
    [
        'register' => false,
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Hak akses admin dan petugas dibatasi melalui controller langsung!!!

Route::group(['middleware' => 'auth'], function () {

    Route::resource('supplier', SupplierController::class);
    Route::get('/cetak-supplier', [App\Http\Controllers\SupplierController::class, 'cetakSupplierPDF'])->name('exportPDF.suppliersAll');

    Route::resource('customer', CustomerController::class);
    Route::get('/cetak-customer', [App\Http\Controllers\CustomerController::class, 'cetakCustomerPDF'])->name('exportPDF.customersAll');

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar-all', [App\Http\Controllers\BarangKeluarController::class, 'laporanBarangKeluarAll']);
    Route::get('/laporan-barangkeluar/{id}', [App\Http\Controllers\BarangKeluarController::class, 'laporanBarangKeluar']);
    Route::get('/cetak-pdf-all', [App\Http\Controllers\BarangKeluarController::class, 'cetakPDF_all'])->name('exportPDF.barangKeluarAll');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk-all', [App\Http\Controllers\BarangMasukController::class, 'laporanBarangMasukAll']);
    Route::get('/laporan-barangmasuk/{id}', [App\Http\Controllers\BarangMasukController::class, 'laporanBarangMasuk']);
    Route::get('/cetak-pdf-all', [App\Http\Controllers\BarangMasukController::class, 'cetakPDF_all'])->name('exportPDF.barangMasukAll');
});
