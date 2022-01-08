<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use App\Models\Barang;
use App\Models\Customer;
use PDF;
use Session;
use Redirect;
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

        $customer = Customer::OrderBy('nama', 'ASC')->get()
                         ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang', 'customer'));
    }

    public function laporanBarangKeluarAll()
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $customer = Customer::OrderBy('nama', 'ASC')->get()
                         ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'barang', 'no', 'customer'));
        
     }
      
    public function laporanBarangKeluar($id)
    {
        $barang = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $customer = Customer::OrderBy('nama', 'ASC')->get()
                         ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::find($id);
        $no = 1;
        return view('barang-keluar.laporanBarangKeluar', compact('barangKeluar', 'barang', 'no', 'customer'));
        
     }

    public function cetakPDF_all()
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data3 = Customer::OrderBy('nama', 'ASC')->get()
                          ->pluck('nama', 'id');


        $data = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluarAll', compact('data', 'data2', 'no', 'data3'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function cetakPDF($id)
    {
        $data2 = Barang::OrderBy('nama_barang', 'ASC')->get()
                         ->pluck('nama_barang', 'id');

        $data3 = Customer::OrderBy('nama', 'ASC')->get()
                         ->pluck('nama', 'id');

        $data = Barang_keluar::find($id);
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluar', compact('data', 'data2', 'no', 'data3'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function store(Request $request)
    {
            $this->validate($request, [
                'id_customer' => 'required',
                'id_barang' => 'required',
                'jumlah' => 'required|numeric|min:0|max:100',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required'
            ]);
            
             Barang_keluar::create($request->all());
             $idStuff = $request->id_barang;
             $qtySend = $request->jumlah;
            
             $barang = Barang::where('id', $idStuff)->first();
             $barang['stok_barang'] -= $qtySend;
             if (count($barang['stock_barang']) < 1) {
                  return Redirect::back()->withError('<strong>Gagal</strong>', 
                                                     'Pengiriman tidak boleh 
                                                      melebihi batas stok tersisa!');
             } 
             $barang->save();
        
             $priceCount = Barang::where('id', $idStuff)->first();
             $priceCount['harga'] *= $qtySend;
             $priceCount->save();
              
             $direct = new Barang_keluar();
             $direct->total = $priceCount;
             $direct->save();
              
             return redirect('barang-keluar')
                                 ->withSuccess('<strong>Berhasil</strong>, 
                                                Barang sedang dikirim ke tempat tujuan!');
                
    }

    public function edit($id)
    {
        $barangKeluar = Barang_keluar::findOrFail($id);
        return view('barang-keluar.edit', compact('barang', 'barangKeluar'));
    }

    public function update(Request $request, $id)
    {
             $this->validate($request, [     
                'id_customer' => 'required',   
                'id_barang' => 'required',
                'jumlah' => 'required|numeric',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required'
            ]);
              $barangKeluar = Barang_keluar::findOrFail($id);
              $barangKeluar->update($request->all());
        
              $barang = Barang::where('id', $request->id_barang)->first();
              $barang->jumlah_barang -= $request->jumlah;
              if ($barang['jumlah_barang'] >= 0) {
                  $barang->save();
                  return redirect('barang-keluar')->withSuccess('<strong>Berhasil</strong>, pengiriman ulang dilakukan!');
              } else {
                 return redirect('barang-keluar')->withError('Gagal', 'Pengiriman tidak boleh melebihi batas stok tersisa!');
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
