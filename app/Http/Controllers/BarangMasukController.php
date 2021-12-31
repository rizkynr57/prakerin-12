<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = Barang_masuk::with('Supplier')->get();
        return view('barang-masuk.index', compact('masuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        return view('barang-masuk.create', compact('supplier'));
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
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required',
            'id_supplier' => 'required',
            'tgl_masuk' => 'required'
        ]);
            $masuk = new Barang_masuk();
            $masuk->nama_barang = $request->nama;
            $masuk->jenis_barang = $request->jenis;
            $masuk->jumlah_barang = $request->jumlah;
            $masuk->id_supplier = $request->id_supplier;
            $masuk->tgl_masuk = $request->tgl_masuk;
            $masuk->save();
            return redirect()->route('barang-masuk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $masuk = Barang_masuk::findOrFail($id);
        return view('barang-masuk.show', compact('masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masuk = Barang_masuk::findOrFail($id);
        $supplier = Supplier::all();
        return view('barang-masuk.edit', compact('masuk', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'perusahaan' => 'required'
        ]);
        $masuk = Barang_masuk::findOrFail($id);
        $masuk->nama_barang = $request->nama;
        $masuk->jenis_barang = $request->jenis;
        $masuk->jumlah_barang = $request->jumlah;
        $masuk->id_supplier = $request->id_supplier;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->save();
        return redirect()->route('barang-masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang_masuk  $barang_masuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masuk = Barang_masuk::findOrFail($id)->delete();
        return redirect()->route('barang-masuk.index');
    }
}
