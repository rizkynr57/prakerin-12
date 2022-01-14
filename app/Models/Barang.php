<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'jumlah_barang',
        'satuan'
    ];

    public $timestamps = true;

    public function barangKeluar()
    {
        return $this->hasMany('App\Models\Barang_keluar', 'id_barang');
    }
    
    public function barangMasuk()
    {
        return $this->hasMany('App\Models\Barang_masuk', 'id_barang');
    }
}
