<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_keluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_supplier',
        'id_barang',
        'jumlah_pengiriman',
        'tgl_pengiriman'
    ];

    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo('App\Models\barang', 'id_barang');
    }
}
