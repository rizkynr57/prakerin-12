<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_masuk;
use App\Exports\BarangMasukExport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Excel;
class BarangMasukController extends Controller
{

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

    public function cetakBM_PDF()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $barangMasuk = Barang_masuk::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangMasukAll', compact('barangMasuk', 'supplier', 'barang', 'no'));
        return $pdf->download('laporan-pemasukan-barang-semua.pdf');
    }

    public function cetakBM_Excel()
    {
        return Excel::download(new BarangMasukExport, 'Barang masuk.xlsx');
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

        return redirect('barang-masuk')->withSuccess('Barang diterima!');
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
        $reset = Barang::findOrFail($request->id_barang);
        $reset['stok_barang'] -= $barangMasuk['jumlah_pemasukan'];
        $reset->save();

        $barangMasuk->jumlah_pemasukan = $request->jumlah;
        $barangMasuk->tgl_masuk = $request->tgl_masuk;
        $barangMasuk->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] += $request->jumlah;
        $barang->save();

        return redirect('barang-masuk')->withInfo('Data telah diubah!');

    }

    public function destroy($id)
    {

        $detail = Barang_masuk::where('id', $id)->get();
        foreach ($detail as $data) {
           $barang = Barang::where('id', $data['id_barang'])->firstOrFail();
           $barang->stok_barang -= $data['jumlah_pemasukan'];
           $barang->save();
        }
        if (!Barang_masuk::destroy($id)) {
            return redirect()->back();
        }
        return redirect('barang-masuk')->withSuccess('Data telah dihapus');
    }
}
