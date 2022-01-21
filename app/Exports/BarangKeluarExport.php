<?php

namespace App\Exports;

use App\Models\Barang_keluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangKeluarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang_keluar::all();
    }
}
