<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistem Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body {
      background: linear-gradient(135deg, #007BFF 0%, #0056b3 70%, #FFA500 100%);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }
    .bg-decor {
      position: absolute;
      top: -80px;
      left: -80px;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      z-index: 0;
    }
    .welcome-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
      padding: 3rem 2rem;
      text-align: center;
      position: relative;
      z-index: 1;
    }
    .btn-custom {
      background: linear-gradient(135deg, #007BFF 0%, #0056b3 80%, #FFA500 100%);
      border: none;
      border-radius: 25px;
      padding: 14px 0;
      font-weight: 600;
      color: white;
      text-decoration: none;
      display: block;
      margin-bottom: 10px;
      transition: all 0.2s;
      font-size: 1.1rem;
      box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
    }
    .btn-custom:hover {
      background: linear-gradient(135deg, #0056b3 0%, #004085 80%, #e67e00 100%);
      transform: translateY(-2px) scale(1.03);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.18);
      color: #fff;
    }
    .text-gradient {
      background: linear-gradient(90deg, #007BFF 0%, #0056b3 70%, #FFA500 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .brand-gradient {
      background: linear-gradient(90deg, #007BFF, #FFA500);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 800;
    }
    @media (max-width: 768px) {
      .welcome-card { padding: 1.5rem 1rem; }
      h1 { font-size: 2rem; }
    }
    @media (max-width: 576px) {
      .welcome-card { padding: 1rem 0.5rem; }
      h1 { font-size: 1.5rem; }
    }
  </style>
</head>
<body>
  <div class="bg-decor"></div>
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-lg-6 col-md-8">
        <div class="welcome-card shadow-lg animate__animated animate__fadeInDown">
         <img src="tomihonk.png" alt="Absensi" class="mb-3 img-fluid" style="max-width: 120px;">
          <h1 class="mb-3 fw-bold text-gradient">
            Sistem Absensi <span class="brand-gradient">TOMIHONK</span>
          </h1>
          <p class="lead mb-4 text-secondary">Selamat datang di sistem absensi digital</p>
          @auth
            <div class="alert alert-success shadow-sm">
              Selamat datang, <b>{{ auth()->user()->name }}</b>!
            </div>
            @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="btn-custom w-100">Dashboard Admin</a>
            @else
              <a href="{{ route('dashboard') }}" class="btn-custom w-100">Dashboard Karyawan</a>
            @endif
          @else
            <div class="d-grid gap-2">
              <a href="{{ route('login') }}" class="btn-custom w-100">Masuk</a>
              <a href="{{ route('register') }}" class="btn-custom w-100">Daftar</a>
            </div>
          @endauth
        </div>
      </div>
    </div>
  </div>
</body>
</html>
