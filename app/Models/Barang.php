<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }
}
