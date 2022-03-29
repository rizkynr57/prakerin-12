<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use Illuminate\Http\Request;

class ApiBarangKeluarController extends Controller
{

    public function index()
    {
        // $barangKeluar = Barang_keluar::all();
        $barangKeluar = DB::table('barang_keluars')
        ->join('customers', 'barang_keluars.id_customer', 'barang_keluar.id_customer')
        ->join('barangs', 'barang_keluars.id_barang', '=', 'barang_keluar.id_barang')
        ->select('customers.nama as pelanggan', 'barangs.nama_barang as barang', 'barang_keluars.jumlah_pengiriman', 'barang_keluars.harga_satuan', 'barang_keluars.tujuan', 'barang_keluars.tgl_pengirimam')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk',
            'data' => $barangKeluar,
        ], 201);
    }

    public function store(Request $request)
    {
          $barangkeluar = new Barang_keluar();
          $barangkeluar->id_customer = $request->id_customer;
          $barangkeluar->id_barang = $request->id_barang;
          $barangkeluar->jumlah_pengiriman = $request->jumlah;
          $getData = Barang::findOrFail($request->id_barang);
          $barangkeluar->harga_satuan = $getData['harga_jual'];
          $barangkeluar->tgl_pengiriman = $request->tgl_pengiriman;
          $barangkeluar->tujuan = $request->tujuan;
          $barangkeluar->save();

          $getData->stok_barang -= $request->jumlah;
          $getData->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Barang Keluar',
            'data' => $barangKeluar,
        ], 201);

    }

    public function show($id)
    {

        $barangKeluar = Barang_keluar::find($id);
        if ($barangKeluar) {
            return response()->json([
                'success' => true,
                'message' => 'Show Data Barang Keluar',
                'data' => $barangKeluar,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Barang Keluar tidak ditemukan',
                'data' => [],
            ], 404);

        }

    }

    public function update(Request $request, $id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        $reset = Barang::findOrFail($request->id_barang);
        $reset['stok_barang'] += $barangKeluar['jumlah_pengiriman'];
        $reset->save();

        $barangKeluar->jumlah_pengiriman = $request->jumlah;
        $barangKeluar->tujuan = $request->tujuan;
        $barangKeluar->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] -= $request->jumlah;
        $barang->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Keluar Berhasil diedit',
            'data' => $barangKeluar,
        ], 201);
    }

    public function destroy($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        $barangKeluar->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Masuk Berhasil hapus',
            'data' => $barangKeluar,
        ], 200);

    }
}
