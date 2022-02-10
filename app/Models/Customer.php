<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telp',
    ];

    public $timestamps = true;

    public function barangKeluar()
    {
        return $this->hasMany('App\Models\Barang_keluar', 'id_customer');
    }

    public static function code()
    {
        $kode = DB::table('customers')->max('kode');
        $addNol = '';
        $kode = str_replace("CTR", "", $kode);
        $kode = (int) $kode + 1;
        $incrementKode = $kode;

        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode == 3)) {
            $addNol = "0";
        }

        $kodeBaru = "CTR" . $addNol . $incrementKode;
        return $kodeBaru;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($barangKeluar) {
          if ($barangKeluar->barangKeluar->count() > 0) {
            Alert::error('Gagal menghapus data '. $barangKeluar->nama_barang. ' karena masih memiliki data barang');
            return false;
          }
        });
    }
}
