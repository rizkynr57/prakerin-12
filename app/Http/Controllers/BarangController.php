<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

         Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil disimpan",
        ]);
         return redirect()->route('barang');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id)
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
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

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil diedit",
        ]);
        return redirect()->route('barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
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
