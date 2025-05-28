<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Ulasan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'User Tidak Diketahui'
        ]);
    }
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'pembelian_id');
    }
}
