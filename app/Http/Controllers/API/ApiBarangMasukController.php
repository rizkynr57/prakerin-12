<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use Illuminate\Http\Request;

class ApiBarangMasukController extends Controller
{

    public function index()
    {
        $barangMasuk = Barang_masuk::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk',
            'data' => $barangMasuk,
        ], 201);
    }

    public function store(Request $request)
    {
        $masuk = new Barang_masuk();
        $masuk->id_supplier = $request->id_supplier;
        $masuk->id_barang = $request->id_barang;
        $masuk->jumlah_pemasukan = $request->jumlah;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang->stok_barang += $request->jumlah;
        $barang->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk',
            'data' => $masuk,
        ], 201);

    }

    public function show($id)
    {

        $barangMasuk = Barang_masuk::find($id);
        if ($barangMasuk) {
            return response()->json([
                'success' => true,
                'message' => 'Show Data Barang Masuk',
                'data' => $barangMasuk,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Barang Masuk tidak ditemukan',
                'data' => [],
            ], 404);

        }

    }

    public function update(Request $request, $id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        $reset = Barang::findOrFail($request->id_barang);
        $reset['stok_barang'] -= $barangMasuk['jumlah_pemasukan'];
        $reset->save();

        $barangMasuk->jumlah_pemasukan = $request->jumlah;
        $barangMasuk->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] += $request->jumlah;
        $barang->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk Berhasil diedit',
            'data' => $barangMasuk,
        ], 201);
    }

    public function destroy($id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        $barangMasuk->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk Berhasil hapus',
            'data' => $barangMasuk,
        ], 200);

    }
}
