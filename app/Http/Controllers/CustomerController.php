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

    public function code()
    {
    	$generateCode = Supplier::all()->get()->max('kode');
    	$addZero = '';
    	$generateCode = str_replace("PGJ", "", $generateCode);
    	$generateCode = (int) $generateCode + 1;
        $addictionalCode = $generateCode;

    	if (strlen($generateCode) == 1) {
    		$addZero = "000";
    	} elseif (strlen($generateCode) == 2) {
    		$addZero = "00";
    	} elseif (strlen($generateCode == 3)) {
    		$addZero = "0";
    	}

    	$newCode = "PRN".$addZero.$addictionalCode;
    	return $newCode;
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
        $this->validate($request, [
            'nama' => 'required|string|unique:customers',
            'alamat' => 'required',
            'email' => 'required|email|unique:customers',
            'no_telp' => 'required'
        ]);
        
        Customer::create($request->all());

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
            'nama' => 'required|string|unique:customer',
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
