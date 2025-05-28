<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UlasanController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:penjualans,id',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:500',
        ]);

        \App\Models\Ulasan::create([
            'pembelian_id' => $request->pembelian_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas ulasannya!');
    }
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'pembelian_id');
    }
    public function destroy(Ulasan $ulasan)
    {
        // Optional: cek user yang hapus harus pemilik ulasan
        if (auth()->id() !== $ulasan->pembelian->user_id) {
            abort(403, 'Unauthorized');
        }

        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
