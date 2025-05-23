<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'nama',
        'alamat',
        'no_hp',
        'jumlah',
        'total_harga'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
