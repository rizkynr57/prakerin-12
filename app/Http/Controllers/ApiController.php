<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Supplier',
            'data' => $supplier,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(request $request)
    {

        $supplier = new Supplier;
        $supplier->kode = $request->kode;
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->no_telp = $request->no_telp;
        $supplier->nama_perusahaan = $request->perusahaan;
        $supplier->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Supplier',
            'data' => $supplier,
        ], 200);

    }

    public function edit($id) 
    {
       //
    }

    public function update(Request $Request, $id)
    {

        $supplier = Supplier::findOrFail($id);
        $supplier->kode = $request->kode;
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->no_telp = $request->no_telp;
        $supplier->nama_perusahaan = $request->perusahaan;
        $supplier->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Supplier',
            'data' => $supplier,
        ], 200);

    }

    public function destroy()
    {
       //
    }
}
