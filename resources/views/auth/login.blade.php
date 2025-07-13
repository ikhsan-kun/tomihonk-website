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
        background: linear-gradient(135deg, #d7e50c, #0adbee, #afd623);
        background-size: 400% 400%;
        animation: gradientFlow 15s ease infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .auth-card {
        background: rgb(251, 248, 248);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        max-width: 340px;
        width: 100%;
        animation: fadeIn 0.5s ease;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .auth-header img {
        width: 60px;
    }

    .auth-header p {
        margin-top: 0.5rem;
        color: #444;
        font-weight: 500;
        font-size: 0.95rem;
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
    }

    .btn-gradient {
        background: linear-gradient(to right, #007bff, #ffff33, #ffa94d);
        background-size: 200% auto;
        color: rgb(241, 238, 238);
        border: none;
        padding: 0.55rem;
        font-weight: 600;
        border-radius: 10px;
        transition: 0.3s ease;
        font-size: 0.95rem;
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
        font-size: 0.9rem;
    }

    a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .alert-danger, .alert-success {
        border: none;
        border-radius: 10px;
        font-size: 0.9rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="auth-card">
    <div class="auth-header">
        <img src="tomihonk.png" alt="Absensi" style="transform: scale(1.5); transition: 0.5s;">
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
        <div class="mb-2">
            <label for="email" class="form-label">📧Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label for="password" class="form-label">🔒Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="checkbox" id="show-password">
            <label for="show-password">Ingatkan Saya</label>
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn-gradient">Masuk</button>
        </div>

        <div class="text-center small">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            <p>Lupa Password? <strong>Hubungi Admin</strong></p>
        </div>
    </form>

</div><script>
    document.getElementById('show-password').addEventListener('change', function () {
        const passwordInput = document.getElementById('password');
        passwordInput.type = this.checked ? 'text' : 'password';
    });
</script>
@endsection
