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
Route::middleware(['auth', 'verified'])->get('/cetak-supplierPDF', [SupplierController::class, 'cetakSupplierPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.suppliersAll');
Route::middleware(['auth', 'verified'])->get('/cetak-supplierExcel', [SupplierController::class, 'cetakSupplierExcel'])
                    ->middleware('role:admin')
                    ->name('exportExcel.suppliersAll');

Route::middleware(['auth', 'verified'])->resource('customer', CustomerController::class)
                    ->middleware('role:admin');
Route::middleware(['auth', 'verified'])->get('/cetak-customerPDF', [CustomerController::class, 'cetakCustomerPDF'])
                    ->middleware('role:admin')
                    ->name('exportPDF.customersAll');
Route::middleware(['auth', 'verified'])->get('/cetak-customerExcel', [CustomerController::class, 'cetakCustomerExcel'])
                    ->middleware('role:admin')
                    ->name('exportExcel.customersAll');

Route::middleware(['auth', 'verified'])->resource('barang', BarangController::class)
                    ->middleware('role:admin|petugas');
Route::middleware(['auth', 'verified'])->get('cetak-barangExcel', [BarangController::class, 'cetakBarangExcel'])
                    ->middleware('role:admin|petugas')
                    ->name('exportExcel.barangAll');

Route::middleware(['auth', 'verified'])->resource('barang-masuk', BarangMasukController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangmasuk-all', [BarangMasukController::class, 'laporanBarangMasukAll'])
                    ->middleware('role:admin|petugas');
Route::middleware(['auth', 'verified'])->get('/cetak-bmPDF', [BarangMasukController::class, 'cetakBM_PDF'])
                    ->middleware('role:admin|petugas')
                    ->name('exportPDF.barangMasuk');
Route::middleware(['auth', 'verified'])->get('/cetak-bmExcel', [BarangMasukController::class, 'cetakBM_Excel'])
                    ->middleware('role:admin|petugas')
                    ->name('exportExcel.barangMasuk');

Route::middleware(['auth', 'verified'])->resource('barang-keluar', BarangKeluarController::class);
Route::middleware(['auth', 'verified'])->get('/laporan-barangkeluar-all', [BarangKeluarController::class, 'laporanBarangKeluarAll'])
                    ->middleware('role:admin|petugas');
Route::middleware(['auth', 'verified'])->get('/cetak-bkPDF', [BarangKeluarController::class, 'cetakBK_PDF'])
                    ->middleware('role:admin|petugas')
                    ->name('exportPDF.barangKeluar');
Route::middleware(['auth', 'verified'])->get('/cetak-bkExcel', [BarangKeluarController::class, 'cetakBK_Excel'])
                    ->middleware('role:admin|petugas')
                    ->name('exportExcel.barangKeluar');
