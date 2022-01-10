<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_telp',
        'email',
        'nama_perusahaan'
    ];

    public $timestamps = true;

    public function barangMasuk()
    {
        return $this->hasMany('App\Models\Barang_masuk', 'id_supplier');
    }

    public function code()
    {
        $generateCode = DB::table('suppliers')->max('kode');
        $addZero = '';
        $generateCode = str_replace("GTJ", "", $generateCode);
        $generateCode = (int) $generateCode + 1;
        $addictionalCode = $generateCode;

        if (strlen($generateCode) == 1) {
            $addZero = "000";
        } elseif (strlen($generateCode) == 2) {
            $addZero = "00";
        } elseif (strlen($generateCode == 3)) {
            $addZero = "0";
        }

        $newCode = "CTR" . $addZero . $addictionalCode;
        return $newCode;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($supplier) {
            if ($supplier->masuk->count() > 0) {
                $msg = 'Data tidak bisa dihapus karena masih ada barang : ';
                $msg .= '<ul>';
                foreach ($supplier->masuk as $data) {
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
