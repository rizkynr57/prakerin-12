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



Route::group(['prefix', 'middleware' => ['auth']], function(){
   
    Route::resource('supplier', SupplierController::class);
    Route::post('/cetak-supplier', SupplierController@cetakSupplierPDF);

    Route::resource('barang', BarangController::class);

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::get('/laporan-barangkeluar, BarangKeluarController@laporanBarangKeluar);
    Route::post('/cetak-pdf', BarangKeluarController@cetakPDF);

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/laporan-barangmasuk, BarangKeluarController@laporanBarangMasuk);
    Route::post('/cetak-pdf', BarangKeluarController@cetakPDF);
});

