<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,petugas');
    }

    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        //

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required|unique:barangs',
            'jenis_barang' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->jenis_barang = $request->jenis_barang;
        $barang->stok_barang = 0;
        $barang->harga = $request->harga;
        if($barang['harga'] >= 100000) {
             $profit = 0.3; // 30%
        } else if ($barang['harga'] >= 70000) {
             $profit = 0.25; // 25%
        } else if ($barang['harga'] >= 50000) {
             $profit = 0.2; // 20%
        } else {
             $profit = 0.1; // 10%
        }
        $barang->harga_jual = $request->harga * $profit;
        $barang->satuan = $request->satuan;
        $barang->save();
        return redirect('barang')->with('success', 'Data disimpan');

    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));

    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|unique:barangs',
            'jenis' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect('barang')->with('success', 'Data berhasil diedit!');
    }

    public function destroy($id)
    {
        if (!Barang::destroy($id)) {
            return redirect()->back();
        }
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
        return redirect()->route('barang');
    }
}
