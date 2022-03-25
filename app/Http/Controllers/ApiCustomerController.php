<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Customer',
            'data' => $customer,
        ], 201);
    }

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->kode = $request->kode;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->email = $request->email;
        $customer->telepon = $request->no_telp;
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Customer',
            'data' => $customer,
        ], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json([
                'success' => true,
                'message' => 'Show Data Customer',
                'data' => $customer,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Customer tidak ditemukan',
                'data' => [],
            ], 404);

        }
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrfail($id);
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->email = $request->email;
        $customer->telepon = $request->no_telp;
        $customer->save();
        return response()->json([
            'success' => true,
            'message' => 'Data Customer Berhasil diedit',
            'data' => $customer,
        ], 201);

    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Customer Berhasil hapus',
            'data' => $customer,
        ], 200);
    }
}
