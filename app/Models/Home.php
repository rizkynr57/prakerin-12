<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Home extends Model
{
    use HasFactory;

    public function barangMasuk()
    {
        return $this->hasMany('App\Models\Barang_masuk');
    }
    public function BarangKeluar()
    {
        return $this->hasMany('app\Models\Barang_keluar');
    }
}
