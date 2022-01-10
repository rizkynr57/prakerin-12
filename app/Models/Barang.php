<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($barang) {
            if ($barang->barangKeluar->count() > 0) {
                $msg = 'Data tidak bisa dihapus karena masih ada barang : ';
                $msg .= '<ul>';
                foreach ($barang->barangKeluar as $data) {
                    $msg .= "<li>$data->nama_barang</li>";
                }
                $msg .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $msg,
                ]);
                return false;
            }
        });
      
        parent::boot();
        self::deleting(function ($barang) {
            if ($barang->barangMasuk->count() > 0) {
                $msg = 'Data tidak bisa dihapus karena masih ada barang : ';
                $msg .= '<ul>';
                foreach ($barang->barangMasuk as $data) {
                    $msg .= "<li>$data->nama_barang</li>";
                }
                $msg .= '</ul>';
                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $msg,
                ]);
                return false;
            }
        });
    }
}
