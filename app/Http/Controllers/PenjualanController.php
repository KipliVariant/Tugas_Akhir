<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penjualans = Penjualan::with(['barang', 'user'])->paginate(10);
        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        // Validasi status yang dikirim
        $request->validate([
            'status' => 'required|in:belum_dikirim,sudah_dikirim',
        ]);

        $penjualan->status = $request->status;
        $penjualan->save();

        return redirect()->route('riwayat.index')->with('success', 'Status pengiriman berhasil diupdate!');
    }
    public function create()
    {
        //
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah'   => 'required|integer|min:1'
        ]);

        $barangs = Barang::findOrFail($request->barang_id);

        if ($barangs->stok < $request->jumlah) {
            return redirect()->back()->with(['error' => 'stok tidak mencukupi']);
        }

        $barangs->decrement('stok', $request->jumlah);

        Penjualan::create([
            'user_id' => auth()->id(),
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil dicatat']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $penjualan = Penjualan::with(['barang', 'user'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
