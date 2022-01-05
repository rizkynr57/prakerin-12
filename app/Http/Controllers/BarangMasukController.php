<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use App\Models\Barang;
use App\Models\Supplier;
use Session;
use PDF;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('role:admin,petugas');
    }

    public function index()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $supplier = Supplier::orderBy('nama_supplier','ASC')->get()
                     ->pluck('nama_supplier','id');

        $barangMasuk = Barang_masuk::all();
        return view('barang-masuk.index', compact('barangMasuk', 'supplier', 'barang'));
    }

    public function laporanBarangMasuk()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $supplier = Supplier::orderBy('nama_supplier', 'ASC')->get()
                          ->pluck('nama_supplier', 'id');

        $barangMasuk = Barang_masuk::all();
        $no = 1;
        return view('barang-masuk.cetaklaporan', compact('barangMasuk', 'supplier', 'barang', 'no'));
    }

    public function cetakPDF()
    {
        $data3 = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $data2 = Supplier::orderBy('nama_supplier', 'ASC')->get()
                          ->pluck('nama_supplier', 'id');

        $data = Barang_masuk::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.cetaklaporan', compact('data', 'data2', 'data3', 'no'));
        return $pdf->download('laporan-pemasukan-barang.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
            Barang_masuk::create($request->all()); 
         
            $barang = Barang::where('id', $request->id_barang)->first();
            $barang->jumlah_barang += $request->jumlah;
            $barang->save();

            return redirect('barang-masuk')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        return view('barang-masuk.show', compact('barangMasuk'));
    }

    public function edit($id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        return view('barang-masuk.edit', compact('barangMasuk', 'supplier'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);

        $barangMasuk = Barang_masuk::findOrFail($id);
        Barang_masuk::update($request->all());
        
        $barang = Barang::where('id', $request->id_barang)->first();
        $barang->jumlah_barang += $request->jumlah;
        $barang->update();
  
        return redirect('barang-masuk')->with('success', 'Data berhasil diedit!');
    }

    public function destroy($id)
    {
        if (!Barang_masuk::destroy($id)){
         return redirect()->back();
        }
       Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
        return redirect()->route('barang-masuk.index');
    }
}
