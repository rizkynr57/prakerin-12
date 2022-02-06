<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Barang_masuk;
use App\Models\Barang_Keluar;
use App\Models\Barang;

class HomeController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $supplier = Supplier::count();
        $customer = Customer::count();
        $masuk = Barang_masuk::count();
        $keluar = Barang_keluar::count();
        $barang = Barang::all();
        return view('home', compact('supplier', 'customer', 'masuk', 'keluar', 'barang'));
    }
}
