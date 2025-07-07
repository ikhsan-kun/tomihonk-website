@extends('layouts.guest')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #003366, #00bfff, #FFD700);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
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
        max-width: 500px;
        margin: 3rem auto;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        font-weight: bold;
        color: #003366;
    }

    .auth-header p {
        color: #444;
        margin-top: 0.5rem;
    }

    .btn-gradient {
        background: linear-gradient(to right, #0056b3, #00bfff, #ffa500);
        border: none;
        color: white;
    }

    .btn-gradient:hover {
        background: linear-gradient(to right, #003366, #00aaff, #e69500);
        color: white;
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
                   id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">🔁 Konfirmasi Password</label>
            <input type="password" class="form-control"
                   id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-gradient btn-lg">Daftar</button>
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
