<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barang_keluar;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;
use Redirect;
use Session;

class BarangKeluarController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin,petugas');
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
        $data2 = Barang::all();
        $data3 = Customer::all();
        $data = Barang_keluar::all();
        $no = 1;
        $pdf = PDF::loadview('barang-masuk.laporanBarangKeluarAll', compact('data', 'data2', 'no', 'data3'));
        return $pdf->download('laporan-pengiriman-barang.pdf');
    }

    public function cetakPDF($id)
    {
        $data2 = Barang::all();
        $data3 = Customer::all();
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
            'jumlah' => 'required',
            'tgl_pengiriman' => 'required',
            'tujuan' => 'required',
        ]);

        $keluar = new Barang_keluar();
        $keluar->id_customer = $request->id_customer;
        $keluar->id_barang = $request->id_barang;
        $price = Barang::findOrFail($request->id_barang);
        $keluar->harga_satuan = $price['harga'];
        $keluar->jumlah_pengiriman = $request->jumlah;
        $keluar->tgl_pengiriman = $request->tgl_pengiriman;
        $keluar->tujuan = $request->tujuan;
        $keluar->save();

        $idStuff = $request->id_barang;
        $qtySend = $request->jumlah;

        $barang = Barang::findOrFail($idStuff);
        $barang['stok_barang'] -= $qtySend;
        $barang->save();

        // $priceCount = Barang::findOrfail($idStuff);
        // $total = $priceCount->harga *= $qtySend;

        // $direct = new Barang_keluar();
        // $direct->total_harga = $total;
        // $direct->save();

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
        return redirect()->route('barang-keluar.index');
    }
}
