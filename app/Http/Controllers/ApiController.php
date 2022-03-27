<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use App\Models\Barang_keluar;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function JoinBarangMasuk()
    {
        $barangMasuk = DB::table('barang_masuks')
        ->join('barangs', 'barang_masuks.id_barang', '=', 'barang_masuk.id_barang')
        ->select('barangs.nama_barang as barang', 'barang_masuks.jumlah_pemasukan', 'barang_masuks.tgl_masuk')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk',
            'data' => $barangMasuk,
        ], 201);
    }

    public function JoinBarangKeluar()
    {
        $barangKeluar = Barang_keluar::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Keluar',
            'data' => $barangKeluar,
        ], 201);
    }
