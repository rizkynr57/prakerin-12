<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(
    [
        'register' => false
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['auth']], function(){
   
    Route::resource('supplier', SupplierController::class);
    Route::get('/cetak-supplier', SupplierController@cetakSupplierPDF)->name('exportPDF.suppliersAll');

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar', BarangKeluarController@laporanBarangKeluar)->name('laporanBarangKeluar');
    Route::get('/cetak-pdf-all', BarangKeluarController@cetakPDF_all)->name('exportPDF.barangKeluarAll');
    Route::get('/cetak-pdf/{id}', BarangKeluarController@cetakPDF')->name('exportPDF.barangKeluar');

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk', BarangKeluarController@laporanBarangMasuk)->name('laporanBarangMasuk');
    Route::get('/cetak-pdf-all', BarangMasukController@cetakPDF_all)->name('exportPDF.barangMasukAll');
    Route::get('/cetak-pdf/{id}', BarangMasukController@cetakPDF)->name('exportPDF.barangMasuk');
});

