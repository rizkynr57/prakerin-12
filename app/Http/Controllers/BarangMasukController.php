<?php

namespace App\Http\Controllers;

use App\Models\Barang_masuk;
use App\Models\Barang;
use App\Models\Supplier;
use Session;
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
        $masuk = Barang_masuk::all();
        $supplier = Supplier::all();
        return view('barang-masuk.index', compact('masuk', 'supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanBarangMasuk()
    {
        $barangMasuk = Barang_masuk::with('Barang', 'Supplier')->get();
        return view('barang-masuk.cetaklaporan', compact('barangMasuk');
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
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
            Barang_masuk::create($request->all());          
            $barang = Barang::where('id', $request->id_barang)->get()->value('jumlah_barang');
            $barang->jumlah_barang += $request->jumlah;
            $barang->save();
            
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data berhasil disimpan",
            ]);
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
            'id_supplier' => 'required',
            'id_barang' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required'
        ]);
        Barang_masuk::create($request->all());
        
        $barang = Barang::where('id', $id)->get()->value('jumlah_barang');
        $barang->jumlah_barang += $request->jumlah;
        $barang->update();
        
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil diedit",
        ]);
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
        if (!Barang_masuk::destroy($id)){
         return redirect()->back();
        }
       Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data berhasil dihapus",
        ]);
        return redirect()->route('barang-masuk.index');
    }
}
