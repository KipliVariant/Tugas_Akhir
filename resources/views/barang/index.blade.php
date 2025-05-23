@extends('layouts.app')
@section('content')


<!-- Your existing content starts here -->
<div class="container py-4" style="font-family: 'Poppins', sans-serif;">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 rounded-4" role="alert">
        <strong>🎉 {{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Form Pencarian dan Filter -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-brown m-0">🍩 Cari Kue</h2>
        <form method="GET" action="{{ route('barang.index') }}" class="d-flex gap-3 flex-wrap">
            <div class="d-flex gap-2">
                <input type="text" name="search" class="form-control rounded-pill py-1 px-2" placeholder="Cari kue..." value="{{ request('search') }}" style="max-width: 180px;">
                <button type="submit" class="btn btn-warning rounded-pill px-3 py-1 fw-semibold">
                    🔍 Cari
                </button>
            </div>
            <div class="d-flex gap-2">
                <select name="filter" class="form-select rounded-pill py-1 custom-select" style="max-width: 160px;">
                    <option value="semua" {{ request('filter') == 'semua' || request('filter') == '' ? 'selected' : '' }}>Semua Stok</option>

                    <option value="tersedia" {{ request('filter') == 'tersedia' ? 'selected' : '' }}>Stok Tersedia</option>
                    <option value="habis" {{ request('filter') == 'habis' ? 'selected' : '' }}>Stok Habis</option>
                </select>
            </div>
        </form>
    </div>
    <br><br>
    <!-- Judul Daftar Kue -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0 text-brown">🍰 Daftar Kue</h2>
        @if (auth()->user()->isAdmin())
        <a href="{{ route('barang.create') }}" class="btn btn-tambah rounded-pill px-4 py-2 fw-semibold">➕ Tambah Kue</a>
        @endif
    </div>


    <div class="row">
        @forelse ($barangs as $barang)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 item-card">

                <div class="position-relative">
                    @if ($barang->stok > 1 && $barang->stok <= 3)
                        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger shadow" style="z-index: 10; font-size: 0.8rem; margin: 20px;">
                        ⚠️ Stok Hampir Habis!
                        </span>
                        @endif

                        <img src="{{ asset('storage/' . $barang->foto) }}" class="card-img-top rounded-top-4 {{ $barang->stok < 1 ? 'grayscale' : '' }}" alt="{{ $barang->nama_barang }}" style="height: 200px; object-fit: cover;">
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-semibold text-brown">{{ $barang->nama_barang }}</h5>
                    <p class="fs-5">💰 Harga: Rp {{ number_format($barang->harga, 0, ',', '.') }} <span class="text-muted">(per pack)</span></p>
                    <p class="card-text">📦 Stok: {{ $barang->stok }}</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        @auth
                        @if (auth()->user()->isAdmin())
                        <!-- Tombol Edit -->
                        <a href="/barang/{{ $barang->id }}/edit" class="btn btn-sm btn-warning rounded-pill px-3">✏️ Edit</a>

                        <!-- Tombol Hapus -->
                        <form method="POST" action="/barang/{{ $barang->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Yakin mau hapus barang ini?')">🗑️ Hapus</button>
                        </form>
                        @endif
                        @endauth
                        <!-- Trigger Modal -->
                        <button class="btn btn-sm btn-info rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#barangModal{{ $barang->id }}">🔎 Detail</button>
                        <!-- Button Beli -->
                        <button class="btn btn-sm btn-success rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#pembelianModal{{ $barang->id }}" {{ $barang->stok < 1 ? 'disabled' : '' }}>🛒 Beli</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Barang -->
        <!-- Modal Detail Barang -->
        <div class="modal fade" id="barangModal{{ $barang->id }}" tabindex="-1" aria-labelledby="barangModalLabel{{ $barang->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="barangModalLabel{{ $barang->id }}">{{ $barang->nama_barang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $barang->foto) }}" class="img-fluid rounded" alt="{{ $barang->nama_barang }}">
                            </div>
                            <div class="col-md-6">
                                <p class="fs-5">💰 Harga: Rp {{ number_format($barang->harga, 0, ',', '.') }} / pack</p>
                                <p class="fs-6">📦 Per pack: {{ $barang->isi_per_pcs }}</p>

                                <p class="fs-6">📦 Stok: {{ $barang->stok }}</p>
                                <hr>
                                <p class="fs-6 text-muted mb-3">{{ $barang->deskripsi }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Pembelian -->
        <!-- Modal Pembelian -->
        <div class="modal fade" id="pembelianModal{{ $barang->id }}" tabindex="-1" aria-labelledby="pembelianModalLabel{{ $barang->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-4 shadow-lg border-0">
                    <div class="modal-header" style="background-color: #795548; color: white;">
                        <h5 class="modal-title" id="pembelianModalLabel{{ $barang->id }}">🛒 Beli {{ $barang->nama_barang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
                    </div>
                    <form action="{{ route('pembelian.store') }}" method="POST">
                        @csrf
                        <div class="modal-body" style="background-color: #F8F3E5;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-brown fw-semibold">Nama Lengkap</label>
                                    <input type="text" placeholder="Masukan Nama!" name="nama" class="form-control rounded-pill" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-brown fw-semibold">Nomor HP</label>
                                    <input type="text" placeholder="Masukan Nomor HP!" name="no_hp" class="form-control rounded-pill" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-brown fw-semibold">Alamat</label>
                                    <textarea name="alamat" placeholder="Masukan Alamatnya, Contoh: Bukit Menteng Blok A0 No 0" class="form-control rounded-4" rows="3" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-brown fw-semibold">Jumlah Kue</label>
                                    <input
                                        placeholder="Mau Beli Berapa pack?"
                                        type="number"
                                        name="jumlah"
                                        class="form-control rounded-pill jumlah-input"
                                        min="1"
                                        max="{{ $barang->stok }}"
                                        required
                                        data-harga="{{ $barang->harga }}">
                                    <small class="text-muted d-block mt-1">🧁 Jumlah kue nambah, harga juga ikut naik ya~ 😋</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-brown fw-semibold">Total Harga</label>
                                    <input type="text" class="form-control rounded-pill total-harga" value="Rp {{ number_format($barang->harga, 0, ',', '.') }}" readonly>
                                    <small class="text-muted d-block mt-1">💰 Total ini ngikutin jumlah yang kamu pilih di atas 👆</small>
                                </div>
                                <!-- Tambahan Catatan Pembayaran -->
                                <div class="col-12 mt-3">
                                    <label class="form-label text-brown fw-semibold">Metode Pembayaran</label>
                                    <div class="form-control rounded-4 bg-light text-muted" style="padding: 15px;">
                                        💳 Pembayaran bisa dilakukan secara:
                                        <ul class="mt-2 mb-0">
                                            <li><strong>Cash</strong> saat pengiriman</li>
                                            <li><strong>Transfer ke rekening BCA:</strong><br>
                                                <span class="d-block mt-1">👤 a.n. <strong>Sinarti</strong></span>
                                                <span class="d-block">🏦 BCA: <strong>7402013381</strong></span>
                                            </li>
                                        </ul>
                                        <br>
                                        📸 Setelah transfer, kirim bukti via WhatsApp ke: <br>
                                        <a href="https://wa.me/6281296903054" target="_blank" class="text-decoration-none fw-semibold text-success">
                                            📲 0812-9690-3054 (Klik buat chat langsung)
                                        </a>
                                    </div>
                                </div>




                                <div class="col-12">
                                    <label class="form-label text-brown fw-semibold">Catatan Ongkir</label>
                                    <!-- <div class="form-control rounded-pill bg-light text-muted" style="padding-top: 10px; padding-bottom: 10px;">
                                        🚚 Pengiriman ke luar Menteng dikenakan ongkir Rp 2.000 ya~ 🍰
                                    </div> -->
                                    <div class="alert alert-warning mt-4 rounded-4" style="background-color: #FFF8E1; color: #8D6E63; border: 1px dashed #BCAAA4;">
                                        ⚠️ <strong>Catatan:</strong> 🚚 Pengiriman ke luar Menteng akan dikenakan <b><u>ongkir Rp 2.000</u></b> ya~ 🍰
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer bg-light rounded-bottom-4">
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">❌ Batal</button>
                            @if ($barang->stok < 1)
                                <span class="badge bg-danger rounded-pill position-absolute top-0 end-0 m-2">Stok Habis</span>
                                @endif

                                <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">✅ Beli</button>
                        </div>
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                    </form>
                </div>
            </div>
        </div>


        @empty
        <div class="col-12 text-center">
            <p class="text-muted">Belum ada kue yang ditambahkan 🍩</p>
        </div>
        @endforelse
    </div>

    @if ($barangs->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        <ul class="pagination d-flex flex-wrap list-unstyled gap-2">
            {{-- Tombol Sebelumnya --}}
            @if ($barangs->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #e0cfc2; color: #7b4b2a; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); border-radius: 12px; padding: 8px 16px;">⏮️</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $barangs->previousPageUrl() }}" style="background-color: #d9b8a4; color: #fff; box-shadow: 2px 2px 5px rgba(0,0,0,0.15); border-radius: 12px; padding: 8px 16px;">⏮️</a>
            </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($barangs->getUrlRange(1, $barangs->lastPage()) as $page => $url)
            @if ($page == $barangs->currentPage())
            <li class="page-item active">
                <span class="page-link" style="background-color: #7b4b2a; color: white; font-weight: bold; box-shadow: 2px 2px 6px rgba(0,0,0,0.2); border-radius: 12px; padding: 8px 16px;">{{ $page }}</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url }}" style="background-color: #f5e1da; color: #7b4b2a; box-shadow: 1px 1px 4px rgba(0,0,0,0.1); border-radius: 12px; padding: 8px 16px;">{{ $page }}</a>
            </li>
            @endif
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($barangs->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $barangs->nextPageUrl() }}" style="background-color: #d9b8a4; color: #fff; box-shadow: 2px 2px 5px rgba(0,0,0,0.15); border-radius: 12px; padding: 8px 16px;">⏭️</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" style="background-color: #e0cfc2; color: #7b4b2a; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); border-radius: 12px; padding: 8px 16px;">⏭️</span>
            </li>
            @endif
        </ul>
    </div>
    @endif





</div>

@push('styles')
<style>
    /* Desain dropdown */
    body {
        background-color: #fdf6f0;
    }

    .grayscale {
        filter: grayscale(100%);
        opacity: 0.7;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .page-item {
        list-style: none;
    }

    .btn-outline-secondary:hover {
        background-color: #5D4037;
        color: #fff;
        transition: 0.3s;
    }

    .page-link {
        padding: 8px 12px;
        border-radius: 8px;
        background-color: #d2b48c;
        /* coklat muda */
        color: white;
        text-decoration: none;
        border: none;
        transition: all 0.3s;
    }

    .page-link:hover {
        background-color: #a67c52;
        /* coklat tua */
        color: #fff;
    }

    .page-item.active .page-link {
        background-color: #7b4b2a;
        /* coklat lebih tua untuk active */
        color: #fff;
    }

    .page-item.disabled .page-link {
        background-color: #eee;
        color: #aaa;
        pointer-events: none;
    }

    .custom-select {
        background-color: #F5F5F5;
        border: 1px solid #795548;
        color: #5D4037;
        transition: all 0.3s ease;
    }

    .custom-select:hover {
        background-color: #FFEB3B;
        border-color: #FF9800;
    }

    .custom-select:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 193, 7, 0.5);
        border-color: #FF9800;
    }

    .custom-select option {
        background-color: #fff;
        color: #5D4037;
    }

    .custom-select option:hover {
        background-color: #FFEB3B;
        color: #5D4037;
    }

    @keyframes goyang {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(1.5deg);
        }

        50% {
            transform: rotate(-1.5deg);
        }

        75% {
            transform: rotate(1deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    .item-card:hover {
        animation: goyang 0.6s ease-in-out;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        transform: scale(1.03);
    }

    .item-card {
        position: relative;
        transition: transform 0.3s ease;
    }

    .item-card::after {
        content: '🍩🍰🍪';
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.4s ease;
        pointer-events: none;
    }

    .item-card:hover::after {
        opacity: 1;
        transform: translateY(0);
    }

    /* Tombol Tambah Kue */
    .btn-tambah {
        background-color: #795548;
        color: white;
        border-radius: 30px;
        /* Lebih membulatkan */
        transition: background-color 0.3s ease;
    }

    .btn-tambah:hover {
        background-color: #6d4c41;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        /* Efek shadow pas hover */
    }


    /* Tombol Edit */
    .btn-edit {
        background-color: #FFA726;
        color: white;
        transition: 0.3s;
    }

    /* Tombol kecil */
    .btn-sm {
        padding: 4px 10px !important;
        font-size: 0.75rem !important;
        border-radius: 20px !important;
    }

    .btn-edit,
    .btn-delete,
    .btn-info,
    .btn-success {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .btn-edit:hover {
        background-color: #fb8c00;
        color: white;
    }

    /* Tombol Hapus */
    .btn-delete {
        background-color: #EF5350;
        color: white;
        transition: 0.3s;
    }

    .btn-delete:hover {
        background-color: #e53935;
        color: white;
    }

    /* Efek hover untuk card */
    .item-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-tambah:hover {
        background-color: #5D4037;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener('input', function() {
            const harga = parseInt(this.dataset.harga);
            const jumlah = parseInt(this.value) || 0;
            const total = harga * jumlah;
            const formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);

            const totalInput = this.closest('.modal-body').querySelector('.total-harga');
            totalInput.value = formatted;
        });
    });
</script>
@endpush

@endsection