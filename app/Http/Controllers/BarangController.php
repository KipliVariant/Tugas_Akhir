<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Barang::query();

        // Pencarian berdasarkan nama_barang
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter stok
        if ($request->has('filter')) {
            if ($request->filter == 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->filter == 'habis') {
                $query->where('stok', '=', 0);
            }
            // kalau 'semua' atau null gak perlu difilter
        }

        $barangs = $query->paginate(6); // biar paginasi tetep bawa query search & filter

        return view('barang.index', compact('barangs'));
    }



    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'required|image',
            'isi_per_pcs' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan gambar
        $path = $request->file('foto')->store('barang', 'public');

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $path,
            'isi_per_pcs' => $request->isi_per_pcs,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'isi_per_pcs' => 'required',
            'deskripsi' => 'required',
            // tambahin validasi lain kalau perlu
        ]);

        $barang = Barang::findOrFail($id);

        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->harga = $request->harga;
        $barang->isi_per_pcs = $request->isi_per_pcs;
        $barang->deskripsi = $request->deskripsi;

        // Kalau ada foto baru
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('barang', 'public');
            $barang->foto = $path;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }
    public function updateAlamat(Request $request)
    {
        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);
        $user = Auth::user();
        if ($user instanceof \Illuminate\Database\Eloquent\Model) {
            $user->alamat = $request->alamat;
            $user->no_hp = $request->input('no_hp');
            $user->save();
        }

        return redirect()->back()->with('status', 'Alamat berhasil diperbarui!');
    }
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        $barang = Barang::with('ulasanDariSemuaPembelian.pembelian.user')->findOrFail($id);
        return view('barang.detail', compact('barang'));
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with(['success' => 'data berhasil dihapus']);
    }
}
