<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Session;
use PDF;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
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
        $supplier = Supplier::all();
        $code = Supplier::code();
        return view('supplier.index', compact('supplier', 'code'));
    }

    public function cetakSupplierPDF()
    {
        $data = Supplier::all();
        $no = 1;
        $pdf = PDF::loadview('supplier.cetaksupplier', compact('data', 'no'));
        return $pdf->download('Data-supplier.pdf');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|unique:suppliers',
            'alamat' => 'required',
            'no_telp' => 'required',
            'perusahaan' => 'required|unique:suppliers'
        ]);
        
        Supplier::create($request->all());

        return redirect('supplier')->with('success', 'Data berhasil disimpan!');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|unique:suppliers',
            'alamat' => 'required',
            'no_telp' => 'required',
            'perusahaan' => 'required|unique:suppliers'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect('supplier')->with('info', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
       if(!Supplier::destroy($id)){
           return redirect()->back();
       }
       Session::flash("flash_notification", [
           "level" => "success",
           "message" => "Data Berhasil Dihapus",
       ]);
       return redirect()->route('supplier');
    }
}
