<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ApiBarangController extends Controller
{

    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang',
            'data' => $barang,
        ], 201);
    }

    public function store(Request $request)
    {
        $barang = new Barang;
        $barang->nama_barang = $request->nama;
        $barang->jenis_barang = $request->jenis;
        $barang->stok_barang = 0;
        $barang->harga = $request->harga;
        if($request->harga >= 100000) {
             $profit = 0.3; // 30%
        } else if ($request->harga >= 70000) {
             $profit = 0.25; // 25%
        } else if ($request->harga >= 50000) {
             $profit = 0.2; // 20%
        } else {
             $profit = 0.1; // 10%
        }
        $addPrice = $request->harga * $profit;
        $barang->harga_jual = $request->harga + $addPrice;
        $barang->satuan = $request->satuan;
        $barang->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang',
            'data' => $barang,
        ], 201);

    }

    public function show($id)
    {

        $barang = Barang::find($id);
        if ($barang) {
            return response()->json([
                'success' => true,
                'message' => 'Show Data Barang',
                'data' => $barang,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Barang tidak ditemukan',
                'data' => [],
            ], 404);

        }

    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama;
        $barang->jenis_barang = $request->jenis;
        $barang->harga = $request->harga;
        if($request->harga >= 100000) {
             $profit = 0.3; // 30%
        } else if ($request->harga >= 70000) {
             $profit = 0.25; // 25%
        } else if ($request->harga >= 50000) {
             $profit = 0.2; // 20%
        } else {
             $profit = 0.1; // 10%
        }
        $addPrice = $request->harga * $profit;
        $barang->harga_jual = $request->harga + $addPrice;
        $barang->satuan = $request->satuan;
        $barang->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Berhasil diedit',
            'data' => $barang,
        ], 201);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Berhasil hapus',
            'data' => $barang,
        ], 200);
    }
}
