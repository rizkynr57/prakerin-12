<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'jumlah_barang',
        'satuan'
    ];

    public $timestamps = true;

    public function masuk()
    {
        return $this->hasMany('App\Models\Barang_masuk', 'id_barang');
    }

    public function keluar()
    {
        return $this->hasMany('App\Models\Barang_keluar', 'id_barang');
    }

}
