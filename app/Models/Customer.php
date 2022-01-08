<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

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
