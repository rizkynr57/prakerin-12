<?php

namespace App\Http\Controllers;

use App\Models\Barang_keluar;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        $keluar = Barang_keluar::all();
        return view('barang-keluar.index', compact('keluar', 'supplier', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();
        return view('barang-keluar.create', compact('supplier', 'barang'));
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
                'jumlah' => 'required',
                'tgl_pengiriman' => 'required',
                'tujuan' => 'required',
            ]);
            $keluar = new Barang_keluar();
            $keluar->id_supplier = $request->id_supplier;
            $keluar->id_barang = $request->id_barang;
            $keluar->jumlah_pengiriman = $request->jumlah;
            $keluar->tgl_pengiriman = $request->tgl_pengiriman;
            $keluar->tujuan = $request->tujuan;
            $keluar->save();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data berhasil disimpan",
            ]);
            return redirect()->route('barang-keluar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function show(barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function edit(barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang_keluar $barang_keluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang_keluar  $barang_keluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang_keluar $barang_keluar)
    {
        //
    }
}
