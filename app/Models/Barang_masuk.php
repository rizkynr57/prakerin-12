<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Barang_masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_supplier',
        'id_barang',
        'jenis_barang',
        'jumlah_pemasukan',
        'tgl_masuk'
    ];

    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'id_supplier');
    }
}
