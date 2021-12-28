<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
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
    return view('welcome');
});

Auth::routes(
    [
        'register' => false
    ]
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('/', function() {
        return view('auth.login');
    });
    Route::resource('supplier', SupplierController::class)->middleware('role:admin');
    Route::resource('barang', BarangController::class)->middleware('role:admin');
    Route::resource('barang-keluar', BarangKeluarController::class)->middleware('role:admin');
    Route::resource('barang-masuk', BarangMasukController::class)->middleware('role:admin');
});

// Route::group(['prefix' => 'petugas', 'middleware' => ['auth', 'role:admin|petugas']], function(){
//     Route::get('/', function() {
//         return view('auth.login');
//     });
//     Route::get('profile', function() {
//         return 'Halaman Profile Petugas';
//     });
// });
