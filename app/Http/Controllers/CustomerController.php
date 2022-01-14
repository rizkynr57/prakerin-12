<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;
use Session;

class CustomerController extends Controller
{

    public function __construct()
    {
        if (Auth::user() == 'petugas') {

            return redirect('home')->withError('Anda tidak memiliki akses pada halaman sebelumnya !');
        }
    }

    public function index()
    {
        $customer = Customer::all();
        $code = Customer::code();
        return view('customer.index', compact('customer', 'code'));
    }

    public function cetakCustomerPDF()
    {
        $data = Customer::all();
        $no = 1;
        $pdf = PDF::loadview('customer.cetakcustomer', compact('data', 'no'));
        return $pdf->download('Data-customer.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:customers',
            'no_telp' => 'required',
        ]);

        $customer = new Customer;
        $customer->kode = $request->kode;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->email = $request->email;
        $customer->telepon = $request->no_telp;
        $customer->save();

        return redirect('customer')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $code = Customer::code();
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer', 'code'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:customer',
            'no_telp' => 'required',
        ]);

        $customer = Customer::findOrfail($id);
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->email = $request->email;
        $customer->telepon = $request->no_telp;
        $customer->update();

        return redirect('customer')->with('info', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        if (!Customer::destroy($id)) {
            return redirect()->back();
        }
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data Berhasil Dihapus",
        ]);
        return redirect()->route('customer.index');
    }
}
