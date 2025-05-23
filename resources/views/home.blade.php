@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; font-family: 'Poppins', sans-serif; background-color: #FFF3E0;">
    <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 600px; border: none; background-color: #FAF0E6;">
        <div class="card-header bg-transparent border-0 text-center">
            <h3 class="fw-bold" style="color: #5D4037;">🎉 Selamat Datang, {{ Auth::user()->name }}!</h3>
        </div>

        <div class="card-body text-center">
            @if (session('status'))
            <div class="alert alert-success" role="alert" style="background-color: #C8E6C9; color: #388E3C;">
                {{ session('status') }}
            </div>
            @endif

            <p class="text-muted mb-4" style="font-size: 1.1rem; color: #5D4037;">Kamu berhasil masuk ke akunmu, silahkan pilih opsi di bawah ini untuk melanjutkan pembelian!</p>

            <!-- Pilihan Menu -->
            <div class="d-grid gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-barang" style="background-color: #5D4037; color: white; border-radius: 12px;">
                    🍰 Ke Halaman Barang
                </a>
                <a href="{{ route('riwayat.index') }}" class="btn btn-barang" style="background-color: #5D4037; color: white; border-radius: 12px;">
                    💵 Ke Halaman Riwayat Penjualan
                </a>
                <a href="{{ route('profil') }}" class="btn btn-barang" style="background-color: #5D4037; color: white; border-radius: 12px;">
                    👤 Lihat Biodata
                </a>
            </div>
            <div class="alert alert-warning mt-4 rounded-4" style="background-color: #FFF8E1; color: #8D6E63; border: 1px dashed #BCAAA4;">
                ⚠️ <strong>Catatan:</strong> Website pembelian ini <u>khusus untuk warga Citra Indah</u>. Di luar area Citra Indah belum bisa ya~ 🙏
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn {
        transition: all 0.3s ease-in-out;
    }

    .btn-barang:hover {
        background-color: #6D4C41;
        transform: scale(1.05);
    }

    .btn-riwayat:hover {
        background-color: #3E2723;
        transform: scale(1.05);
    }
</style>
@endpush