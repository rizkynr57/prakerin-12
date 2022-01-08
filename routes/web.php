<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(
    [
        'register' => false
    ]
);

Route::get('/home', HomeController@index)->name('home');

// Hak akses admin dan petugas dibatasi melalui controller langsung!!!

Route::group(['middleware' => 'auth'], function(){
   
    Route::resource('supplier', SupplierController::class);
    Route::get('/cetak-supplier', SupplierController@cetakSupplierPDF)->name('exportPDF.suppliersAll');

    Route::resource('customer', CustomerController::class);
    Route::get('/cetak-customer', CustomerController@cetakCustomerPDF)->name('exportPDF.customersAll');

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar-all', BarangKeluarController@laporanBarangKeluarAll)->name('laporanBarangKeluarAll');
    Route::get('/laporan-barangkeluar/{id}', BarangKeluarController@laporanBarangKeluar)->name('laporanBarangKeluar');
    Route::get('/cetak-pdf-all', BarangKeluarController@cetakPDF_all)->name('exportPDF.barangKeluarAll');
    Route::get('/cetak-pdf/{id}', BarangKeluarController@cetakPDF)->name('exportPDF.barangKeluar');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk-all', BarangMasukController@laporanBarangMasukAll)->name('laporanBarangMasukAll');
    Route::get('/laporan-barangmasuk/{id}', BarangMasukController@laporanBarangMasuk)->name('laporanBarangMasuk');
    Route::get('/cetak-pdf-all', BarangMasukController@cetakPDF_all)->name('exportPDF.barangMasukAll');
    Route::get('/cetak-pdf/{id}', BarangMasukController@cetakPDF)->name('exportPDF.barangMasuk');
});

