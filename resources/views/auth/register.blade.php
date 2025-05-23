@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; font-family: 'Poppins', sans-serif; background-color: #FFF3E0;">
    <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 500px; border: none; background-color: #FAF0E6;">
        <div class="card-header bg-transparent border-0 text-center">
            <h3 class="fw-bold" style="color: #5D4037;">🍰 Register Dulu Yuk!</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label" style="color: #5D4037;">👤 Nama</label>
                    <input id="name" type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" style="color: #5D4037;">📧 Email</label>
                    <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="color: #5D4037;">🔒 Password</label>
                    <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label" style="color: #5D4037;">🔐 Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="form-control rounded-3" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn" style="background-color: #5D4037; color: white; border-radius: 12px;">
                        🍪 Daftar Sekarang
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" style="color: #8D6E63;">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection