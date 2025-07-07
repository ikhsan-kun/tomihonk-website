@extends('layouts.guest')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #d7e50c, #0adbee, #afd623);
        background-size: 300% 300%;
        animation: gradientFlow 10s ease infinite;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .auth-card {
        background: rgb(251, 248, 248);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        max-width: 420px;
        width: 100%;
        animation: fadeIn 0.5s ease;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .auth-header img {
        width: 80px;
    }

    .auth-header p {
        margin-top: 0.75rem;
        color: #444;
        font-weight: 500;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
    }

    .btn-gradient {
        background: linear-gradient(to right, #007bff, #ffff33, #ffa94d);
        background-size: 200% auto;
        color: rgb(241, 238, 238);
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s ease;
    }

    .btn-gradient:hover {
        background-position: right center;
        transform: scale(1.02);
    }

    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }

    a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .alert-danger, .alert-success {
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="auth-card">
    <div class="auth-header">
        <img src="tomihonk.png" alt="Absensi">
        <p>Silakan masuk ke akun Anda</p>
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

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="remember" name="remember">
    <label class="form-check-label" for="remember">Ingat saya
</div>

<script>
    document.getElementById('remember').addEventListener('change', function () {
        const input = document.getElementById('password');
        input.type = this.checked ? 'text' : 'password';
    });
</script>

        <div class="d-grid mb-3">
            <button type="submit" class="btn-gradient">Masuk</button>
        </div>

        <div class="text-center">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>
    </form>
</div>
<script>
    document.getElementById('showPassword').addEventListener('change', function () {
        const input = document.getElementById('password');
        input.type = this.checked ? 'text' : 'password';
    });
</script>
@endsection
