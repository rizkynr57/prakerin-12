<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $jenis = Jenis::all();
        return view('jenis.index', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
        ]);
        $jenis = new Jenis();
        $jenis->nama_jenis = $request->jenis;
        return redirect('jenis')->withSuccess('Data Berhasil Disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
        ]);

        $jenis = Jenis::findOrFail($id);
        $jenis->nama_jenis = $request->jenis;
        $jenis->update();

        return redirect('jenis')->withInfo('Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $jenis = Jenis::find($id);
        if (!Jenis::destroy($id)) {
            return redirect()->back();
        }
        return redirect('jenis')->withSuccess('Data '.$jenis->nama_jenis. ' telah dihapus');
    }
}
