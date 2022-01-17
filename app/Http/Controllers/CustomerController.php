<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;
use Session;
use Str;
use DataTables;

class CustomerController extends Controller
{

    public function __construct()
    {
      if (Str::length(Auth::user()) > 0)
         if (Auth::user()->role = "petugas") {
            return redirect('home')->withError('Anda tidak memiliki akses pada halaman sebelumnya !');
         }
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

    public function ApiCustomer() 
    {
        $customer = Customer::all();
        return DataTables::of($customer)
                 ->AddColumn('action' function($customer) {
                  return '<a href="#" class="btn btn-warning"><i class="fas fa-id-card"></i>Show</a>' .
                       '<a onclick="editForm('.$customer->id.')" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>' .
                       '<a onclick="deleteData('.$customer->id.')" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>';
                });
                ->rawColumns(['action'])->make(true);
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

        return redirect('customer')->withSuccess('Data berhasil disimpan!');
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

        return redirect('customer')->withInfo('Data berhasil diubah!');
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
        return redirect('customer')->withSuccess('Data telah dihapus');
    }
}
