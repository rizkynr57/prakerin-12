<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{

    public function index()
    {
        $satuan = Satuan::all();
        return view('satuan.index', compact('satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required',
        ]);
        $satuan = new Satuan();
        $satuan->nama_satuan = $request->satuan;
        return redirect('satuan')->withSuccess('Data Berhasil Disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'satuan' => 'required',
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->nama_satuan = $request->satuan;
        $satuab->update();

        return redirect('satuan')->withInfo('Data berhasil diubah!');
    }

    public function show($id)
    {
        $satuan = Satuan::find($id);
        return view('satuan.show', compact('satuan'));
    }

    public function destroy($id)
    {
        $satuan = Satuan::find($id);
        if (!Satuan::destroy($id)) {
            return redirect()->back();
        }
        return redirect('satuan')->withSuccess('Data '.$satuan->nama_satuan. ' telah dihapus');
    }
}
