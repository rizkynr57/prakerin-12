<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SatuanController;
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
Route::middleware(['auth', 'verified'])->get('/cetak-supplierPDF', [SupplierController::class, 'cetakSupplierPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.suppliersAll');

Route::middleware(['auth', 'verified'])->resource('customer', CustomerController::class)
                    ->middleware('role:admin');
Route::middleware(['auth', 'verified'])->get('/cetak-customerPDF', [CustomerController::class, 'cetakCustomerPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.customersAll');

Route::middleware(['auth', 'verified'])->resource('jenis', JenisController::class)
                    ->middleware('role:admin|petugas');

Route::middleware(['auth', 'verified'])->resource('satuan', SatuanController::class)
                    ->middleware('role:admin|petugas');

Route::middleware(['auth', 'verified'])->resource('barang', BarangController::class)
                    ->middleware('role:admin|petugas');

Route::middleware(['auth', 'verified'])->resource('barang-masuk', BarangMasukController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangmasuk-all', [BarangMasukController::class, 'laporanBarangMasukAll'])
                    ->middleware('role:admin|petugas');
Route::middleware(['auth', 'verified'])->get('/cetak-bmPDF', [BarangMasukController::class, 'cetakBM_PDF'])
                    ->middleware('role:admin|petugas')
                    ->name('exportPDF.barangMasuk');

Route::middleware(['auth', 'verified'])->resource('barang-keluar', BarangKeluarController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangkeluar-all', [BarangKeluarController::class, 'laporanBarangKeluarAll'])
                    ->middleware('role:admin|petugas');
Route::middleware(['auth', 'verified'])->get('/cetak-bkPDF', [BarangKeluarController::class, 'cetakBK_PDF'])
                    ->middleware('role:admin|petugas')
                    ->name('exportPDF.barangKeluar');
