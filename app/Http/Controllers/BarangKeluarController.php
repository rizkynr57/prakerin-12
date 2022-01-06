<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use App\Models\Barang;
use PDF;
use Alert;
use Session;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin,petugas');
    }

    public function index()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang', $hitungSisa));
    }

    public function laporanBarangKeluarAll()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'barang', 'no'));
        
     }
      
    public function laporanBarangKeluar($id)
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $barangKeluar = Barang_keluar::find($id);
        $no = 1;
        return view('barang-keluar.laporanBarangKeluar', compact('barangKeluar', 'barang', 'no'));
        
     }

    public function cetakPDF_all()
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluarAll', compact('data', 'data2', 'no'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function cetakPDF($id)
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data = Barang_keluar::find($id);
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluar', compact('data', 'data2', 'no'));
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
             if ($barang['jumlah_barang'] >= 0) {
                 $barang->save();
                 return redirect('barang-keluar')->withSuccess('<strong>Berhasil</strong>, barang sedang dikirim ke tempat tujuan!');
             } else {
                 return redirect('barang-keluar')->alert()->error('Gagal', 'Pengiriman tidak boleh melebihi batas stok tersisa!');
             }           
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
              if ($barang['jumlah_barang'] >= 0) {
                  $barang->save();
                  return redirect('barang-keluar')->withSuccess('<strong>Berhasil</strong>, pengiriman ulang dilakukan!');
              } else {
                 return redirect('barang-keluar')->alert()->error('Gagal', 'Pengiriman tidak boleh melebihi batas stok tersisa!');
             }
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
