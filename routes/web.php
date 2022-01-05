<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupplierController;
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

Route::get('/home', HomeController@index])->name('home');

// Hak akses admin dan petugas dibatasi melalui controller

Route::group(['middleware' => ['auth']], function(){
   
    Route::resource('supplier', SupplierController::class);
    Route::get('/cetak-supplier', SupplierController@cetakSupplierPDF)->name('exportPDF.suppliersAll');

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar', BarangKeluarController@laporanBarangKeluar)->name('laporanBarangKeluar');
    Route::get('/cetak-pdf-all', BarangKeluarController@cetakPDF_all)->name('exportPDF.barangKeluarAll');
    Route::get('/cetak-pdf/{id}', BarangKeluarController@cetakPDF)->name('exportPDF.barangKeluar');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk', BarangKeluarController@laporanBarangMasuk)->name('laporanBarangMasuk');
    Route::get('/cetak-pdf-all', BarangMasukController@cetakPDF_all)->name('exportPDF.barangMasukAll');
    Route::get('/cetak-pdf/{id}', BarangMasukController@cetakPDF)->name('exportPDF.barangMasuk');
});

