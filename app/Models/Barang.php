<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_barang',
        'id_barang',
        'jumlah_barang',
        'id_satuan'
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

    public static function code()
    {
        $kode = DB::table('barangs')->max('kode');
        $addNol = '';
        $kode = str_replace("BRG", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode == 3)) {
            $addNol = "0";
        }

        $kodeBaru = "BRG" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}
