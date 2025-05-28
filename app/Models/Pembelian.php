<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Ulasan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'pembelian_id');
    }
}
