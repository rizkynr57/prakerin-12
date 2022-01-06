<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMasuk = DB::table('barang_masuk')->get()->sum('jumlah_pemasukan');
        $totalKeluar = DB::table('barang_keluar')->get()->sum('jumlah_pengiriman');
        return view('home')->with('jumlah_penerimaan', 'jumlah_pengiriman', $totalMasuk, $totalKeluar);
    }
}
