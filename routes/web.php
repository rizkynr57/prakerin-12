<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(
    [
        'register' => false,
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->resource('supplier', SupplierController::class)
                    ->middleware('role:admin');
Route::middleware(['auth', 'verified'])->get('/cetak-supplier', [SupplierController::class, 'cetakSupplierPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.suppliersAll');

Route::middleware(['auth', 'verified'])->resource('customer', CustomerController::class)
                    ->middleware('role:admin');;
Route::middleware(['auth', 'verified'])->get('/cetak-customer', [CustomerController::class, 'cetakCustomerPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.customersAll');

Route::middleware(['auth', 'verified'])->resource('barang', BarangController::class);

Route::middleware(['auth', 'verified'])->resource('barang-masuk', BarangMasukController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangmasuk-all', [BarangMasukController::class, 'laporanBarangMasukAll'])
                    ->middleware('role:admin');
Route::middleware(['auth', 'verified'])->get('/cetak-bm', [BarangMasukController::class, 'cetakBM'])
                    ->middleware('role:admin')
                    ->name('exportPDF.barangMasuk');

Route::middleware(['auth', 'verified'])->resource('barang-keluar', BarangKeluarController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangkeluar-all', [BarangKeluarController::class, 'laporanBarangKeluarAll'])
                    ->middleware('role:admin');
Route::middleware(['auth', 'verified'])->get('/cetak-bk', [BarangKeluarController::class, 'cetakBK'])
                    ->middleware('role:admin')
                    ->name('exportPDF.barangKeluar');
