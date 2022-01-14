<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_keluar;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;
use Session;

class BarangKeluarController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang', 'customer'));
    }

    public function laporanBarangKeluarAll()
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'barang',
            'no', 'customer'));

    }

    public function laporanBarangKeluar($id)
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangKeluar = Barang_keluar::find($id);
        $no = 1;
        return view('barang-keluar.laporanBarangKeluar', compact('barangKeluar', 'barang', 'no', 'customer'));

    }

    public function cetakPDF_all()
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangMasuk = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluarAll', compact('barangKeluar', 'customer', 'no', 'barang'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function cetakPDF($id)
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangMasuk = Barang_keluar::find($id);
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluar', compact('barangKeluar', 'customer', 'no', 'barang'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
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

        $keluar = new Barang_keluar();
        $keluar->id_customer = $request->id_customer;
        $keluar->id_barang = $request->id_barang;
        $keluar->jumlah_pengiriman = $request->jumlah;

        $getData = Barang::findOrFail($request->id_barang);

        $keluar->harga_satuan = $getData['harga_jual'];
        $keluar->satuan = $getData['satuan'];
        $keluar->tgl_pengiriman = $request->tgl_pengiriman;
        $keluar->tujuan = $request->tujuan;
        $keluar->save();

        $getData->stok_barang -= $request->jumlah;
        $getData->save();

        return redirect('barang-keluar')
            ->withSuccess('<strong>Berhasil</strong>,
                                            Barang sedang dikirim ke tempat tujuan!');

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
        $reset->update();
        
        $barangKeluar->jumlah_pemasukan = $request->jumlah;
        $barangKeluar->tgl_pengiriman = $request->tgl_pengiriman;
        $barangKeluar->update();

        $barang = Barang_keluar::find($request->id_barang);
        $barang['stok_barang'] -= $request->jumlah;
        $barang->update();

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
        return redirect()->route('barang-keluar.index');
    }
}
