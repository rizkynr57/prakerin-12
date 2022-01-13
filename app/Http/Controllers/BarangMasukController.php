<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_masuk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PDF;
use Session;

class BarangMasukController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin,petugas');
    }

    public function index()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $barangMasuk = Barang_masuk::all();
        return view('barang-masuk.index', compact('barangMasuk', 'supplier', 'barang'));
    }

    public function laporanBarangMasukAll()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $barangMasuk = Barang_masuk::all();
        $no = 1;
        return view('barang-masuk.laporanBarangMasukAll', compact('barangMasuk', 'supplier', 'barang',
            'no'));
    }

    public function laporanBarangMasuk($id)
    {
        $barang = Barang::all();
        $supplier = Supplier::all();
        $data = Barang_masuk::all();
        $barangMasuk = Barang_masuk::find($id);
        $no = 1;
        return view('barang-masuk.laporanBarangMasuk', compact('barangMasuk', 'supplier', 'barang', 'no'));
    }

    public function cetakPDF_all()
    {
        $data3 = Barang::all();
        $data2 = Supplier::all();
        $data = Barang_masuk::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangMasukAll', compact('data', 'data2', 'data3', 'no'));
        return $pdf->download('laporan-pemasukan-barang-semua.pdf');
    }

    public function cetakPDF($id)
    {
        $data3 = Barang::all();
        $data2 = Supplier::all();
        $data = Barang_masuk::findOrFail($id);
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangMasuk', compact('data', 'data2', 'data3', 'no'));
        return $pdf->download('laporan-pemasukan-barang-satuan.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'tgl_masuk' => 'required',
        ]);

        $masuk = new Barang_masuk();
        $masuk->id_supplier = $request->id_supplier;
        $masuk->id_barang = $request->id_barang;
        $masuk->jumlah_pemasukan = $request->jumlah;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang->stok_barang += $request->jumlah;
        $barang->save();

        return redirect('barang-masuk')->with('success', 'Barang diterima!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'tgl_masuk' => 'required',
        ]);

        $barangMasuk = Barang_masuk::findOrFail($id);
        $barangMasuk->jumlah_pemasukan = $request->jumlah;
        $barangMasuk->tgl_masuk = $request->tgl_masuk;
        $barangMasuk->update();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] += $request->jumlah;
        $barang->update();
        return redirect('barang-masuk')->with('success', 'Data berhasil diedit!');

    }

    public function destroy($id)
    {
        if (!Barang_masuk::destroy($id)) {
            return redirect()->back();
        }
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
        return redirect()->route('barang-masuk.index');
    }
}
