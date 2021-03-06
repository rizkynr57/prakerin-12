<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $code = Supplier::code();
        $supplier = Supplier::all();
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
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'perusahaan' => 'required',
        ]);
        $supplier = new Supplier();
        $supplier->kode = $request->kode;
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->no_telp = $request->no_telp;
        $supplier->nama_perusahaan = $request->perusahaan;
        $supplier->save();

        return redirect('supplier')->withSuccess('Data Berhasil Disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'perusahaan' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->nama_supplier = $request->nama;
        $supplier->alamat = $request->alamat;
        $supplier->no_telp = $request->no_telp;
        $supplier->nama_perusahaan = $request->perusahaan;
        $supplier->update();

        return redirect('supplier')->withInfo('Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if (!Supplier::destroy($id)) {
            return redirect()->back();
        }
        return redirect('supplier')->withSuccess('Data '.$supplier->nama_supplier. ' telah dihapus');
    }
}
