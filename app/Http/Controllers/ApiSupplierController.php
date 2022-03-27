<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class ApiSupplierController extends Controller
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

    public function store(Request $request)
    {
        $supplier = new Supplier();
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
        ], 201);
    }

    public function show($id) 
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return response()->json([
                'success' => true,
                'message' => 'Show Data Supplier',
                'data' => $supplier,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Supplier tidak ditemukan',
                'data' => [],
            ], 404);

        }
    }

    public function update(Request $request, $id)
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
            'message' => 'Data Kategori Berhasil diedit',
            'data' => $supplier,
        ], 201);

    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Supplier Berhasil hapus',
            'data' => $supplier,
        ], 200);
    }
}
