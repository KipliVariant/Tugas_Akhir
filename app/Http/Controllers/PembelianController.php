<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Penjualan;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Penjualan::with('barang')->latest()->get();
        ($pembelians); // Debug untuk melihat data pembelian dan barang
        return view('pembelian.index', compact('pembelians'));
    }

    //
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jumlah' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi 😢');
        }

        $total_harga = $barang->harga * $request->jumlah;

        Penjualan::create([
            'user_id' => auth()->id(),
            'barang_id' => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'harga' => $barang->harga,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status' => 'menunggu',
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->back()->with('success', 'Terima kasih sudah membeli! 🍰 Pesananmu sedang diproses.');
    }
}
