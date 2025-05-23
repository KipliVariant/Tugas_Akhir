@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh; font-family: 'Poppins', sans-serif; background-color: #FFF3E0;">
    <div class="card shadow-lg rounded-4 p-4" style="width: 100%; max-width: 500px; border: none; background-color: #FAF0E6;">
        <div class="card-header bg-transparent border-0 text-center">
            <h3 class="fw-bold" style="color: #5D4037;">🍰 Login Dulu Yuk!</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label" style="color: #5D4037;">📧 Email</label>
                    <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="color: #5D4037;">🔒 Password</label>
                    <input id="password" type="password"
                        class="form-control rounded-3 @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember" style="color: #5D4037;">
                        Ingat saya 🍩
                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn" style="background-color: #5D4037; color: white; border-radius: 12px;">
                        🍰 Login Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection