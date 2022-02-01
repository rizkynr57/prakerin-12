<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Exports\BarangExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class BarangController extends Controller
{

    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function cetakBarangExcel()
    {
        return Excel::download(new BarangExport, 'Data Barang.xlsx');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = new Barang;
        $barang->nama_barang = $request->nama;
        $barang->jenis_barang = $request->jenis;
        $barang->stok_barang = 0;
        $barang->harga = $request->harga;
        if($request->harga >= 100000) {
             $profit = 0.3; // 30%
        } else if ($request->harga >= 70000) {
             $profit = 0.25; // 25%
        } else if ($request->harga >= 50000) {
             $profit = 0.2; // 20%
        } else {
             $profit = 0.1; // 10%
        }
        $addPrice = $request->harga * $profit;
        $barang->harga_jual = $request->harga + $addPrice;
        $barang->satuan = $request->satuan;
        $barang->save();

        return redirect('barang')->withSuccess('Data disimpan');

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama;
        $barang->jenis_barang = $request->jenis;
        $barang->harga = $request->harga;
        if($request->harga >= 100000) {
             $profit = 0.3; // 30%
        } else if ($request->harga >= 70000) {
             $profit = 0.25; // 25%
        } else if ($request->harga >= 50000) {
             $profit = 0.2; // 20%
        } else {
             $profit = 0.1; // 10%
        }
        $addPrice = $request->harga * $profit;
        $barang->harga_jual = $request->harga + $addPrice;
        $barang->satuan = $request->satuan;
        $barang->save();

        return redirect('barang')->withInfo('Data telah diubah!');
    }
}
