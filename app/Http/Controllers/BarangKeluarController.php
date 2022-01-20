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

    public function index()
    {
        $barang = Barang::all();
        $customer = Customer::all();
        $barangKeluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('barangKeluar', 'barang', 'customer'));
    }

    public function laporanBarangKeluarAll()
    {
        $customer = Customer::all();
        $barang = Barang::all();
        $barangKeluar = Barang_keluar::all();
        $no = 1;
        return view('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'customer', 'barang',
            'no'));
    }

    public function cetakBK()
    {
        $customer = Customer::all();
        $barang = Barang::all();
        $barangKeluar = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-keluar.laporanBarangKeluarAll', compact('barangKeluar', 'customer', 'barang', 'no'));
        return $pdf->download('laporan-pengiriman-barang-semua.pdf');
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

        $barangkeluar = new Barang_keluar;
        $barangkeluar->id_customer = $request->id_customer;
        $barangkeluar->id_barang = $request->id_barang;
        $barangkeluar->jumlah_pengiriman = $request->jumlah;

        $getData = Barang::findOrFail($request->id_barang);

        $barangkeluar->harga_satuan = $getData['harga_jual'];
        $barangkeluar->tgl_pengiriman = $request->tgl_pengiriman;
        $barangkeluar->tujuan = $request->tujuan;
        $barangkeluar->save();

        $getData['stok_barang'] -= $request->jumlah;
        $getData->save();

        return redirect('barang-keluar')->withSuccess('Barang telah dikirim');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_customer' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',
            'tgl_pengiriman' => 'required',
            'tujuan' => 'required',
        ]);

        $barangKeluar = Barang_keluar::findOrFail($id);
        $reset = Barang::findOrFail($request->id_barang);
        $reset['stok_barang'] += $barangKeluar['jumlah_pengiriman'];
        $reset->save();

        $barangKeluar->jumlah_pengiriman = $request->jumlah;
        $barangKeluar->tgl_pengiriman = $request->tgl_pengiriman;
        $barangKeluar->tujuan = $request->tujuan;
        $barangKeluar->save();

        $barang = Barang::findOrFail($request->id_barang);
        $barang['stok_barang'] -= $request->jumlah;
        $barang->save();

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
