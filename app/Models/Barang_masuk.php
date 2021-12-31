<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_supplier',
        'jenis_barang',
        'jumlah_penerimaan',
        'tgl_masuk'
    ];
    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'id_supplier');
    }
}
