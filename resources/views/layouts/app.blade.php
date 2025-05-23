<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background-color: #FFF3E0 !important;
        }

        .navbar a.nav-link,
        .navbar a.navbar-brand {
            color: #fff !important;
            transition: color 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .navbar a.nav-link:hover,
        .navbar a.navbar-brand:hover {
            color: #FFD180 !important;
            /* warna hover karamel */
        }

        /* Animasi glow buat tombol */
        .navbar .btn {
            transition: all 0.3s ease;
        }

        .navbar .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #FFD180, 0 0 20px #FFD180;
        }

        .navbar .btn-danger:hover {
            box-shadow: 0 0 10px #ef9a9a, 0 0 20px #ef9a9a;
        }

        .navbar .btn-outline-light:hover {
            background-color: #fff;
            color: #5D4037;
            box-shadow: 0 0 10px #fff3e0;
        }

        .navbar .btn-light:hover {
            background-color: #FFE0B2;
            color: #5D4037;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: #5D4037;">
            <div class="container">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}" style="color: #fff; font-family: 'Poppins', sans-serif;">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height: 40px; width: 40px; border-radius: 50%; border: 2px solid white; object-fit: cover; margin-right: 10px;">
                    {{ config('app.name', 'TokoKue') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto align-items-center gap-2">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-3" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-3" href="{{ route('register') }}">Register</a>
                        </li>
                        @endif
                        @else
                        @auth
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">👥 Data Pengguna (Khusus Admin)</a>
                        </li>
                        @endif
                        @endauth

                        <li class="nav-item">
                            <a class="btn btn-warning rounded-pill px-3 fw-bold" href="{{ route('barang.index') }}">🛍️ Belanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light rounded-pill px-3 fw-bold" href="{{ route('riwayat.index') }}">📜 Riwayat</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-3 fw-bold" href="{{ route('profil') }}">👤 Profil</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded-pill px-3 fw-bold">🚪 Logout</button>
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>