<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_keluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'jumlah_pengiriman',
        'tujuan',
        'tgl_pengiriman'
    ];

    public $timestamps = true;

    public function home()
    {
        return $this->hasMany(Home::class);
    }

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }
}
