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
        $barangMasuk = Barang_masuk::all();
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
