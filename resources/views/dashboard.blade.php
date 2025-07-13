@extends('layouts.app')

@section('content')
<style>
    .bg-gradient-blue-orange {
        background: linear-gradient(135deg, #0056b3, #00bfff, #ffa500);
        color: white;
    }

    .card-glow {
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.2), 0 0 20px rgba(255, 165, 0, 0.2);
        border: none;
        border-radius: 1rem;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #007bff, #ffa500);
        border: none;
        color: white;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #0056b3, #ff8c00);
        color: white;
    }

    .welcome-card {
        padding: 2rem;
        border-radius: 1rem;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="bg-gradient-blue-orange p-4 mb-4 text-center rounded shadow-sm">
           <h2 class="fw-bold mb-1">Selamat Datang di Sistem Absensi </h2>
           <h5 class="text-light fw-semibold mt-2" style="letter-spacing: 1px;">
                PT Tomihonk Network Nusantara
           </h5>
        </div>
        @if(auth()->user()->isAdmin())
            <div class="alert alert-info text-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-gradient">Masuk ke Admin Panel</a>
            </div>
        @endif
        <div class="card card-glow welcome-card text-center">
            <div class="card-body">
                <h4 class="fw-bold text-dark">Hai, {{ Auth::user()->name }} 👋</h4>
                <p class="text-muted mb-4">Semoga harimu menyenangkan! Silakan lakukan absensi di bawah ini.</p>
                <div class="card shadow-lg rounded-4 p-4">
                <a href="{{ route('absensi.create') }}" class="btn btn-gradient btn-lg mb-3">📍 Absen Sekarang</a>
                <a href="{{ route('absensi.index') }}" class="btn btn-outline-info btn-lg">📅 Riwayat Absensi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
