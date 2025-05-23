@extends('layouts.app')

@section('content')
<div class="container py-4" style="font-family: 'Poppins', sans-serif;">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-dark text-white text-center rounded-top-4">
            <h3 class="fw-bold mb-0">📋 Daftar Seluruh Pengguna</h3>
        </div>
        <div class="card-body p-4" style="background-color:rgb(97, 97, 97);">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center shadow-sm rounded">
                    <thead class="table-dark" style="background-color:rgb(97, 97, 97);">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Alamat</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $index => $user)
                        <tr style="background-color: #ffffff;">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_hp ?? '-' }}</td>
                            <td>{{ $user->alamat ?? '-' }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada pengguna 😢</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection