<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Session;
use PDF;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin,petugas');
    }

    public function index()
    {
        $customer = Customer::all();
        return view('customer.index', compact('customer'));
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
        $this->validate($request, [
            'nama' => 'required|string|unique:customer',
            'alamat' => 'required',
            'email' => 'required|email|unique:customer',
            'no_telp' => 'required'
        ]);
        
        customer::create($request->all());

        return redirect('customer')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            nama' => 'required|string|unique:customer',
            'alamat' => 'required',
            'email' => 'required|email|unique:customer',
            'no_telp' => 'required'
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect('customer')->with('info', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
       if(!Customer::destroy($id)){
           return redirect()->back();
       }
       Session::flash("flash_notification", [
           "level" => "success",
           "message" => "Data Berhasil Dihapus",
       ]);
       return redirect()->route('customer.index');
    }
}
