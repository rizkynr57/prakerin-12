<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use App\Models\Barang;
use PDF;
use Session;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    
    public function index()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');


        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang'));
    }

    public function laporanBarangKeluar()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.cetaklaporan', compact('barangKeluar', 'barang', 'no'));
        
     }

    public function cetakPDF()
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.cetaklaporan', compact('data', 'data2', 'no'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function store(Request $request)
    {
            $request->validate([
                'id_barang' => 'required',
                'jumlah' => 'required|numeric',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required',
            ]);
        
             Barang_keluar::create($request->all());
            
             $barang = Barang::where('id', $request->id_barang)->first();
             $barang->jumlah_barang -= $request->jumlah;

             if ($barang['jumlah_barang'] < 1) {
              Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Pengiriman tidak boleh melebihi batas tersisa",
              ]);
             } else {
                 $barang->save()
             }

             return redirect('barang-keluar')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        return view('barang-keluar.show', compact('barangKeluar'));
    }

    public function edit($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        return view('barang-keluar.edit', compact('barang', 'barangKeluar'));
    }

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
        
              $barang = Barang::where('id', $request->id_barang)->first();
              $barang->jumlah_barang -= $request->jumlah;

              if ($barang['jumlah_barang'] < 1) {
                 Session::flash("flash_notification", [
                   "level" => "danger",
                   "message" => "Data berhasil dihapus",
              ]);
               } else {
                  $barang->save()
             }

        return redirect('barang-keluar')->with('success', 'Data berhasil diedit!');
    }

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
