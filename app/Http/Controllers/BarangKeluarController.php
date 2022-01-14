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
        $keluar->total_harga = 0;
        $keluar->tujuan = $request->tujuan;
        $keluar->save();

        $idStuff = $request->id_barang;
        $qtySend = $request->jumlah;

        $barang = Barang::findOrfail($idStuff);
        $barang->stok_barang -= $qtySend;
        $barang->save();

        // $totalHarga = new Barang_keluar;
        // $totalHarga->total_harga = $getData['harga_jual'] * $qtySend;
        // $totalHarga->save();

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

        $barangMasuk = Barang_masuk::findOrFail($id);
        $barangMasuk->jumlah_pemasukan = $request->jumlah;
        $barangMasuk->tgl_pengiriman = $request->tgl_pengiriman;
        $barangMasuk->update();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] -= $request->jumlah;
        $barang->update();

        return redirect('barang-keluar')->withSuccess('Data Diubah');
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
        return redirect()->route('barang-keluar.index');
    }
}
