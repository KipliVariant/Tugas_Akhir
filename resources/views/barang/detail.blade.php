<h4 class="fw-bold">⭐ Ulasan Pembeli</h4>

@forelse ($barang->ulasanDariSemuaPembelian as $ulasan)
<div class="card mb-3 p-3 shadow-sm">
    <div>
        <strong>{{ $ulasan->pembelian->user->name ?? 'Pengguna' }}</strong>
    </div>
    <div class="text-warning">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <=$ulasan->rating)
            ⭐
            @else
            ☆
            @endif
            @endfor
    </div>
    <p class="text-muted mt-2">{{ $ulasan->ulasan }}</p>
</div>
@empty
<div class="text-muted">Belum ada ulasan untuk kue ini 😢</div>
@endforelse