<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Ulasan;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'barang_id');
    }

    public function ulasanDariSemuaPembelian()
    {
        return $this->hasManyThrough(
            Ulasan::class,
            Penjualan::class,
            'barang_id',        // Foreign key di penjualan
            'pembelian_id',     // Foreign key di ulasan
            'id',               // Primary key di barang
            'id'                // Primary key di penjualan
        );
    }
}
