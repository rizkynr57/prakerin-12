<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use App\Models\Barang;
use PDF;
use Session;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');


        $barangKeluarkeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanBarangKeluar()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.cetaklaporan', compact('barangKeluar', 'barang'));
        
     }

    public function cetakPDF()
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data = Barang_keluar::all();
        $pdf = PDF::loadview('barang-masuk.cetaklaporan', compact('data', 'data2'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate([
                'id_barang' => 'required',
                'jumlah' => 'required|numeric',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required',
            ]);
        
             Barang_keluar::create($request->all());
            
             $barang = Barang::where('id', '=', $request->id_barang)->first();
             $barang->jumlah_barang -= $request->jumlah;
             $barang->save();
        
             return redirect('barang-keluar')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        return view('barang-keluar.show', compact('barangKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        return view('barang-keluar.edit', compact('barang', 'barangKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
                
                'id_barang' => 'required',
                'jumlah' => 'required|numeric',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required',
            ]);
        $barangKeluar = Barang_keluar::findOrFail($id);
        $barangKeluar->update($request->all());
        
        $barang = Barang::where('id', '=', $request->id_barang)->first();
        $barang->jumlah_barang -= $request->jumlah;
        $barang->save();

        return redirect('barang-keluar')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Barang_keluar::destroy($id)) {
            return redirect()->back();
           }
                Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data berhasil dihapus",
            ]);
             return redirect()->route('barang-keluar');
    }
}
