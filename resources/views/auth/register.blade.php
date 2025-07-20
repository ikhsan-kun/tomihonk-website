@extends('layouts.guest')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #003366, #00bfff, #FFD700);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .register-card {
        background: rgb(234, 230, 230);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 340px; /* Sesuaikan ukuran agar mirip login */
    }

    .auth-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .auth-header h1 {
        font-weight: bold;
        color: #003366;
        font-size: 1.5rem;
    }

    .auth-header p {
        color: #444;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 8px 10px;
        font-size: 0.9rem;
        background-color: #e8f0fe;
        border: 1px solid #ccc;
    }

    .btn-gradient {
        background: linear-gradient(to right, #0056b3, #00bfff, #ffa500);
        border: none;
        color: white;
        padding: 0.6rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s ease;
    }

    .btn-gradient:hover {
        background-position: right center;
        transform: scale(1.02);
    }

    .alert-danger {
        border-radius: 10px;
        padding: 0.75rem;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .register-card {
            padding: 1.2rem;
            border-radius: 0.8rem;
        }

        .auth-header h1 {
            font-size: 1.25rem;
        }

        .btn-gradient {
            font-size: 0.9rem;
        }
    }
</style>
<div class="register-card">
    <div class="auth-header">
        <h1>📝 Daftar</h1>
        <p>Buat akun baru untuk mulai absensi</p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">👤 Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">🔒 Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" value="{{ old('password') }}" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-gradient">Daftar</button>
        </div>
        <div class="text-center">
            <p>Sudah punya akun?
                <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</div>
@endsection
