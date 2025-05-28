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
            @if($pembelian->status == 'sudah_dikirim')
            <div class="mt-4">
                <h6 class="fw-bold mb-2">📝 Beri Ulasan dan Rating</h6>
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pembelian_id" value="{{ $pembelian->id }}">
                    <div class="mb-2">
                        <label for="rating" class="form-label">Rating (1-5):</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Pilih rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} ⭐</option>
                                @endfor
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="ulasan" class="form-label">Ulasan:</label>
                        <textarea name="ulasan" id="ulasan" rows="3" class="form-control" placeholder="Tulis pendapat kamu..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Kirim Ulasan</button>
                </form>
            </div>
            @endif

            <form action="{{ route('penjualan.updateStatus', $pembelian->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <select name="status" class="form-select">
                        <option value="belum_dikirim" {{ $pembelian->status == 'belum_dikirim' ? 'selected' : '' }}>Belum Terkirim</option>
                        <option value="sudah_dikirim" {{ $pembelian->status == 'sudah_dikirim' ? 'selected' : '' }}>Sudah Terkirim</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Update Status</button>
            </form>
            @if($pembelian->ulasan)
            <hr class="my-4">
            <div class="mt-3">
                <h6 class="fw-bold mb-2">📝 Ulasan dari Kamu</h6>
                <div>
                    <strong>Rating:</strong>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <=$pembelian->ulasan->rating)
                        ⭐
                        @else
                        ☆
                        @endif
                        @endfor
                </div>
                <div class="mt-2">
                    <strong>Ulasan:</strong>
                    <p class="text-muted mb-0">{{ $pembelian->ulasan->ulasan }}</p>
                </div>
            </div>
            @endif

        </div>
    </div>
    @empty
    <div class="alert alert-warning text-center">Belum ada riwayat pembelian 😢</div>
    @endforelse
</div>
@endsection