<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'nama_barang' => $row[1],
            'jenis_barang' => $row[2],
            'stok_barang' => $row[3],
            'harga' => $row[4],
            'harga_jual' => $row[5],
            'satuan' => $row[6]
        ]);
    }
}
