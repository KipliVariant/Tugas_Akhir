@extends('layouts.app')

@section('content')
<div class="container py-4" style="font-family: 'Poppins', sans-serif;">
    <h2 class="fw-bold text-brown mb-4 text-center">🍰 Riwayat Pembelian Kamu</h2>

    @php
    $statusClass = [
    'belum_dikirim' => 'bg-warning',
    'sudah_dikirim' => 'bg-success'
    ];
    @endphp

    @forelse ($pembelians as $pembelian)
    <div class="card mb-4 shadow-lg border-0 rounded-4" style="background-color: #fff9f4; box-shadow: 0 8px 16px rgba(0,0,0,0.1);">
        <div class="card-body py-4 px-5">
            <h5 class="card-title fw-bold text-brown mb-3">
                📦 Pembelian - {{ $pembelian->created_at->format('d M Y, H:i') }}
            </h5>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <strong>Nama Pembeli:</strong>
                    <div class="text-muted">{{ $pembelian->nama }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>No HP:</strong>
                    <div class="text-muted">{{ $pembelian->no_hp }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Alamat:</strong>
                    <div class="text-muted">{{ $pembelian->alamat }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Kue:</strong>
                    <div class="text-muted">{{ $pembelian->barang->nama_barang ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Jumlah:</strong>
                    <div class="text-muted">{{ $pembelian->jumlah }}</div>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Total Harga:</strong>
                    <div class="text-success fw-semibold">Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Status Pengiriman -->
            <div class="mt-3">
                <strong>Status Pengiriman:</strong>
                <div class="badge {{ $statusClass[$pembelian->status] ?? 'bg-secondary' }} text-white text-capitalize">
                    {{ ucwords(str_replace('_', ' ', $pembelian->status)) }}
                </div>
            </div>

            <!-- Jika admin, tampilkan form update status -->
            @if(auth()->user()->role === 'admin')
            <form action="{{ route('penjualan.updateStatus', $pembelian->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <select name="status" class="form-select">
                        <option value="belum_dikirim" {{ $pembelian->status == 'belum_dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                        <option value="sudah_dikirim" {{ $pembelian->status == 'sudah_dikirim' ? 'selected' : '' }}>Sudah Dikirim</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
            </form>
            @endif
        </div>
    </div>
    @empty
    <div class="alert alert-warning text-center">Belum ada riwayat pembelian 😢</div>
    @endforelse
</div>
@endsection