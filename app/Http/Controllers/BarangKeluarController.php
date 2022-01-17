<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_keluar;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;
use Session;
use DataTables;

class BarangKeluarController extends Controller
{

    public function index()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                           ->pluck('nama_barang', 'id');

        $customer = Customer::orderBy('nama', 'ASC')->get()
                           ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang', 'customer'));
    }

    public function laporanBarangKeluarAll()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                           ->pluck('nama_barang', 'id');

        $customer = Customer::orderBy('nama', 'ASC')->get()
                           ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'barang',
            'no', 'customer'));

    }

    public function laporanBarangKeluar($id)
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                           ->pluck('nama_barang', 'id');

        $customer = Customer::orderBy('nama', 'ASC')->get()
                           ->pluck('nama', 'id');

        $barangKeluar = Barang_keluar::find($id);
        $no = 1;
        return view('barang-keluar.laporanBarangKeluar', compact('barangKeluar', 'barang', 'no', 'customer'));

    }

    public function cetakPDF_all()
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                           ->pluck('nama_barang', 'id');

        $customer = Customer::orderBy('nama', 'ASC')->get()
                           ->pluck('nama', 'id');

        $barangMasuk = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluarAll', compact('barangKeluar', 'customer', 'no', 'barang'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function cetakPDF($id)
    {
        $barang = Barang::orderBy('nama_barang', 'ASC')->get()
                           ->pluck('nama_barang', 'id');

        $customer = Customer::orderBy('nama', 'ASC')->get()
                           ->pluck('nama', 'id');

        $barangMasuk = Barang_keluar::find($id);
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluar', compact('barangKeluar', 'customer', 'no', 'barang'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function ApiOut()
    {
        $barangKeluar = Barang_keluar::all();

        return Datatables::of($barangKeluar)
            ->addColumn('nama_barang', function ($barangKeluar){
                return $barangKeluar->barang->nama_barang;
            })
            ->addColumn('nama_customer', function ($barangKeluar){
                return $barangKeluar->customer->nama;
            })
            ->addColumn('action', function($barangKeluar){
                return '<a href="#" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $barangKeluar->id .')" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $barangKeluar->id .')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['nama_barang', 'nama_customer', 'action'])->make(true);
           
         return view('barang-keluar.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_customer' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'tgl_pengiriman' => 'required',
            'tujuan' => 'required',
        ]);

        $barangkeluar = new Barang_keluar();
        $barangkeluar->id_customer = $request->id_customer;
        $barangkeluar->id_barang = $request->id_barang;
        $barangkeluar->jumlah_pengiriman = $request->jumlah;

        $getData = Barang::findOrFail($request->id_barang);

        $barangKeluar->harga_satuan = $getData['harga_jual'];
        $barangkeluar->satuan = $getData['satuan'];
        $barangkeluar->tgl_pengiriman = $request->tgl_pengiriman;
        $barangkeluar->tujuan = $request->tujuan;

        $getData['stok_barang'] -= $request->jumlah;
        if ($request->jumlah > $getData['stok_barang']) {
              return back()->withError('Tidak boleh melebihi batas sisa');
       } else {
             $barangKeluar->save();
             $getData->save();
      
             $total = Barang_keluar::find($request->id_barang);
             $total->total_harga = $total['harga_satuan'] * $total['jumlah_pengiriman'];
             $total->save();
       }

        return redirect('barang-keluar')->withSuccess('Barang sedang dikirim ke tempat tujuan!');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'tgl_pengiriman' => 'required',
            'tujuan' => 'required',
        ]);

        $barangKeluar = Barang_keluar::findOrFail($id);
        $reset = Barang::findOrFail($request->id_barang);
        $reset['stok_barang'] += $barangKeluar['jumlah_pengiriman'];
        $reset->save();
        
        $barangKeluar->jumlah_pemasukan = $request->jumlah;
        $barangKeluar->tgl_pengiriman = $request->tgl_pengiriman;

        $barang = Barang::find($request->id_barang);
        $barang['stok_barang'] -= $request->jumlah;
        if ($request->jumlah > $getData['stok_barang']) {
              return back()->withError('Tidak boleh melebihi batas sisa');
        } else {
        $barangKeluar->save();
        $barang->update();
    
        $total = Barang_keluar::find($request->id_barang);
        $total->total_harga = $total['harga_satuan'] * $total['jumlah_pengiriman'];
        $total->update();
        }

        return redirect('barang-keluar')->withInfo('Data telah Diubah');
    }

    public function destroy($id)
    {
        $barangKeluar = Barang_keluar::find($id);
        $barang = Barang::where('id', $barangKeluar->id_barang)->firstOrFail();
        $barang->stok_barang += $barangKeluar->jumlah_pengiriman;
        $barang->save();

        if (!Barang_keluar::destroy($id)) {
            return redirect()->back();
        }
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
        return redirect('barang-keluar')->withSuccess('Data telah dihapus');
    }
}
