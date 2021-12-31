<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

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

    public function masuk()
    {
        return $this->hasMany('App\Models\Barang_masuk', 'id_supplier');
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
