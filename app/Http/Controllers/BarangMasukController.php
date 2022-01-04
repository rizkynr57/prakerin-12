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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $supplier = Supplier::orderBy('nama_supplier','ASC')->get()
                     ->pluck('nama_supplier','id');

        $barangMasuk = Barang_masuk::all();
        return view('barang-masuk.index', compact('barangMasuk', 'supplier', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanBarangMasuk()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $supplier = Supplier::orderBy('nama_supplier', 'ASC')->get()
                          ->pluck('nama_supplier', 'id');

        $barangMasuk = Barang_masuk::all();
        return view('barang-masuk.cetaklaporan', compact('barangMasuk', 'supplier', 'barang');
    }

    public function cetakPDF()
    {
        $data3 = Barang::orderBy('nama_barang', 'ASC')->get()
                          ->pluck('nama_barang', 'id');

        $data2 = Supplier::orderBy('nama_supplier', 'ASC')->get()
                          ->pluck('nama_supplier', 'id');

        $data = Barang_masuk::all();
        $pdf = PDF::loadview('barang-masuk.cetaklaporan', compact('data', 'data2', 'data3'));
        return $pdf->download('laporan-pemasukan-barang.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
            Barang_masuk::create($request->all()); 
         
            $barang = Barang::where('id', '=', $request->id_barang)->first();
            $barang->jumlah_barang += $request->jumlah;
            $barang->save();

            return redirect('barang-masuk')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        return view('barang-masuk.show', compact('barangMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barangMasuk = Barang_masuk::findOrFail($id);
        return view('barang-masuk.edit', compact('barangMasuk', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
        Barang_masuk::create($request->all());
        
        $barang = Barang::where('id', '=', $id)->get()->first();
        $barang->jumlah_barang += $request->jumlah;
        $barang->update();
  
        return redirect('barang-masuk')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
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
