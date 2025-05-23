@extends('layouts.app')

@section('content')
<div class="container py-5" style="font-family: 'Poppins', sans-serif;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4" style="background-color: #fff9f4;">
                <div class="card-header text-white fw-bold rounded-top-4" style="background-color: #8B4513;">
                    🔐 Reset Password
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-brown">📧 Alamat Email</label>
                            <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-brown">🔒 Password Baru</label>
                            <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold text-brown">🔁 Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control rounded-3" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn px-4 py-2 text-white rounded-3" style="background-color: #A0522D;">
                                🔁 Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-brown {
        color: #8B4513;
    }
</style>
@endsection