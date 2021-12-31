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



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('/', function() {
        return view('home');
    });
    Route::resource('supplier', SupplierController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
});

Route::group(['prefix' => 'petugas', 'middleware' => ['auth', 'role:petugas|admin']], function(){
    Route::get('/', function() {
        return view('home');
    });
    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
});
