@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-4 p-4" style="max-width: 600px; margin: auto; background-color: #FAF0E6;">
        <div class="card-header bg-transparent border-0 text-center">
            <h1 class="fw-bold" style="color: #5D4037;">🛒 Edit Barang</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Barang -->
                <div class="mb-3">
                    <label for="nama_barang" class="form-label" style="color: #5D4037;">📦 Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control rounded-3 @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label for="stok" class="form-label" style="color: #5D4037;">📊 Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control rounded-3 @error('stok') is-invalid @enderror" value="{{ old('stok', $barang->stok) }}" required>
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label" style="color: #5D4037;">💰 Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control rounded-3 @error('harga') is-invalid @enderror" value="{{ old('harga', $barang->harga) }}" required>
                    @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- Isi per pcs -->
                <div class="mb-3">
                    <label for="isi_per_pcs" class="form-label" style="color: #5D4037;">📦 Isi per pack</label>
                    <input type="text" name="isi_per_pcs" id="isi_per_pcs" class="form-control rounded-3 @error('isi_per_pcs') is-invalid @enderror" value="{{ old('isi_per_pcs', $barang->isi_per_pcs) }}" required placeholder="Contoh: 3 potong, 1 toples, dll">
                    @error('isi_per_pcs')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label" style="color: #5D4037;">📝 Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" placeholder="Tulis deskripsi kue di sini...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Foto Barang -->
                <div class="mb-3">
                    <label for="foto" class="form-label" style="color: #5D4037;">📸 Foto Barang</label><br>
                    @if($barang->foto)
                    <img src="{{ asset('storage/'.$barang->foto) }}" alt="{{ $barang->nama_barang }}" class="mb-2" style="width: 150px; border-radius: 8px;">
                    <p class="text-muted">Gambar saat ini</p>
                    @endif
                    <input type="file" name="foto" id="foto" class="form-control rounded-3 @error('foto') is-invalid @enderror">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                    @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Button Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background-color:rgb(92, 59, 47); border-radius: 12px;">
                        💡 Update Barang
                    </button>
                </div>

                <!-- Button Batal -->
                <div class="text-center mt-3">
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary" style="border-radius: 12px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection