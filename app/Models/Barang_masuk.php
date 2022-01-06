<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Barang_masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_supplier',
        'jenis_barang',
        'jumlah_barang',
        'tgl_masuk'
    ];

    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'id_supplier');
    }

    public function home()
    {
        return $this->belongsTo('App\Models\Home');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($barang) {
            if ($supplier->barang->count() > 0) {
                $msg = 'Data tidak bisa dihapus karena masih ada barang : ';
                $msg .= '<ul>';
                foreach ($barang->barang as $data) {
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
