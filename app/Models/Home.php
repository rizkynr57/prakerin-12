<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Home extends Model
{
    use HasFactory;

    public function In()
    {
        return $this->belongsTo(Barang_masuk::class);
    }

    public function Out()
    {
        return $this->belongsTo(Barang_keluar::class);
    }
    
}

