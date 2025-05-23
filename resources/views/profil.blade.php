@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh; font-family: 'Poppins', sans-serif; background-color: #FFF3E0;">
    <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 600px; background-color: #FAF0E6;">
        <div class="card-header bg-transparent text-center">
            <h3 class="fw-bold" style="color: #5D4037;">👤 Biodata Kamu</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush" style="font-size: 1.1rem;">
                <li class="list-group-item">🧑 Nama: <strong>{{ Auth::user()->name }}</strong></li>
                <li class="list-group-item">📧 Email: <strong>{{ Auth::user()->email }}</strong></li>
                <li class="list-group-item">🆔 ID User: <strong>{{ Auth::user()->id }}</strong></li>
                <li class="list-group-item">🏠 Alamat: </a><strong>{{ Auth::user()->alamat }}</strong></li>
                <li class="list-group-item">📱 Nomor HP: <strong>{{ Auth::user()->no_hp }}</strong></li>

                <form action="{{ route('update-alamat') }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Ini WAJIB kalau route-nya PUT -->

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', Auth::user()->alamat) }}">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', Auth::user()->no_hp) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>





                <!-- Bisa tambahin data lain kalau ada -->
            </ul>
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary rounded-pill">🔙 Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection