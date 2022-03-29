<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class Satuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jenis',
    ];

    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany('App\Models\Barang', 'id_satuan');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($barangMasuk) {
          if ($barang->barang->count() > 0) {
            Alert::error('Gagal menghapus data '. $barang->nama_jenis. ' karena masih memiliki data barang');
            return false;
          }
        });
    }
}
