<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telp'
    ];

    public $timestamps = true;

    public function barangKeluar()
    {
        return $this->hasMany('App\Models\Barang_keluar', 'id_customer');
    }

    public function code()
    {
        $generateCode = DB::table('customers')->max('kode');
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
        self::deleting(function ($customer) {
            if ($customer->barangKeluar->count() > 0) {
                $msg = 'Data tidak bisa dihapus karena masih ada barang : ';
                $msg .= '<ul>';
                foreach ($customer->barangKeluar as $data) {
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
