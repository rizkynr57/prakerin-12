<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
   
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        

    }

    public function store(Request $request)
    {
        $request->validate([
           'nama' => 'required|unique',
           'jenis' => 'required',
           'satuan' => 'required'
       ]);

         $barang = new Barang;
         $barang->nama_barang = $required->nama,
         $barang->jenis_barang = $required->jenis,
         $barang->jumlah_barang = 0;
         $barang->satuan = $request->satuan;
         $barang->save();
         return redirect('barang')->with('success', 'Data berhasil disimpan!');
        
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id)
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'nama' => 'required|unique',
          'jenis' => 'required',
          'satuan' => 'required'
        ]);
        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama;
        $barang->jenis_barang = $request->jenis;
        $barang->satuan = $request->satuan;
        $barang->update();
        return redirect('barang')->with('success', 'Data berhasil diedit!');
    }

    public function destroy($id)
    {
        If(!Barang::destroy($id)) {
          return redirect()->back();
    }
      Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
      return redirect()->route('barang');
}
