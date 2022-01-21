<?php

namespace App\Exports;

use App\Models\Barang_masuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang_masuk::all();
    }
}
