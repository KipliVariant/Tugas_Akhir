<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pembelian()
    {
        return $this->belongsTo(Penjualan::class, 'pembelian_id');
    }
}
