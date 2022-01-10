<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Home extends Model
{
    use HasFactory;

    public function InOut()
    {
        return $this->hasManyThrough(related:Barang_masuk::class, related:Barang_keluar::class);
    }

    
}

