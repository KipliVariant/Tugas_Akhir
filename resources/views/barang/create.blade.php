@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container py-4" style="font-family: 'Poppins', sans-serif;">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-brown text-white d-flex justify-content-between align-items-center">
            <h1 class="m-0 fs-3">🧁 Tambah Barang</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nama_barang" class="form-label">🍪 Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="stok" class="form-label">📦 Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="harga" class="form-label">💰 Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="isi_per_pcs" class="form-label">🎁 Isi per pack</label>
                        <input type="text" name="isi_per_pcs" id="isi_per_pcs" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label for="deskripsi" class="form-label">📝 Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Tulis deskripsi lucu tentang kue ini..." required></textarea>
                    </div>

                    <div class="col-md-12">
                        <label for="foto" class="form-label">📸 Foto Barang</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                    </div>

                    <div id="preview-container" class="col-md-12" style="display: none;">
                        <label class="form-label">👀 Preview Foto</label>
                        <img id="preview" src="" alt="Preview Foto" class="img-fluid rounded-3 border shadow-sm" style="max-height: 250px; object-fit: cover;">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">💾 Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary px-4 py-2">❌ Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endpush

@push('styles')
<style>
    .bg-brown {
        background-color: #5D4037;
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }

    .form-control {
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 10px 15px;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
    }

    .btn {
        border-radius: 12px;
        font-size: 0.95rem;
        transition: 0.3s ease;
    }

    .btn-primary {
        background-color: #795548;
        border: none;
    }

    .btn-primary:hover {
        background-color: #6d4c41;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #d7ccc8;
        color: #3e2723;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #bcaaa4;
        color: white;
        transform: scale(1.05);
    }
</style>
@endpush