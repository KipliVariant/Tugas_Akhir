<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RiwayatPembelianController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Ambil semua riwayat tanpa filter user_id
            $pembelians = \App\Models\Penjualan::latest()->get();
        } else {
            // User cuma lihat transaksi milik dia sendiri
            $pembelians = \App\Models\Penjualan::where('user_id', auth()->id())->latest()->get();
        }

        return view('riwayat.index', compact('pembelians'));
    }
}
