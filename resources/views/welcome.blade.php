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
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(20px); }
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
      transform: translateY(-2px) scale(1.04);
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
      .btn-custom { font-size: 1rem; padding: 12px 0; }
    }

    /* Modal Zoom */
    #logoModal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.8);
      text-align: center;
      transition: opacity 0.3s ease;
      opacity: 0;
    }

    #logoModal img {
      margin-top: 5%;
      max-width: 80%;
      max-height: 80%;
    }

    #logoModal span {
      position: absolute;
      top: 20px;
      right: 30px;
      color: white;
      font-size: 30px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="bg-decor"></div>
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-lg-6 col-md-8">
        <div class="welcome-card shadow-lg animate__animated animate__fadeInDown">
          <img src="tomihonk.png" alt="Absensi"
            id="logo"
            class="mb-4 img-fluid animate__animated animate__fadeIn animate__delay-2s"
            style="max-width: 80px; transform: scale(2.2);">
          <h1 class="mb-3 fw-bold text-gradient animate__animated animate__fadeInUp animate__delay-1s">
            <span class="brand-gradient">Sistem Absensi Digital</span>
          </h1>
          <p class="lead mb-4 text-secondary animate__animated animate__fadeInUp animate__delay-2s">
            Hai, Selamat datang! Silahkan absen dimanapun dan kapanpun dengan mudah dan cepat.
          </p>

          @auth
            <div class="alert alert-success shadow-sm animate__animated animate__fadeInUp animate__delay-3s">
              Selamat datang, <b>{{ auth()->user()->name }}</b>!
            </div>
            @if(auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" class="btn-custom w-100 animate__animated animate__fadeInUp animate__delay-3s">Dashboard Admin</a>
            @else
              <a href="{{ route('dashboard') }}" class="btn-custom w-100 animate__animated animate__fadeInUp animate__delay-3s">Dashboard Karyawan</a>
            @endif
          @else
            <div class="d-grid gap-2">
              <div class="animate__animated animate__fadeInUp animate__delay-3s">
                <a href="{{ route('login') }}" class="btn-custom w-100">Masuk</a>
              </div>
              <div class="animate__animated animate__fadeInUp animate__delay-4s">
                <a href="{{ route('register') }}" class="btn-custom w-100">Daftar</a>
              </div>
            </div>
          @endauth
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Zoom Logo -->
  <div id="logoModal">
    <span onclick="closeModal()">&times;</span>
    <img src="tomihonk.png" alt="Logo Zoom">
  </div>

  <script>
    const modal = document.getElementById('logoModal');
    const logo = document.getElementById('logo');

    logo.addEventListener('click', function () {
      modal.style.display = 'block';
      setTimeout(() => {
        modal.style.opacity = 1;
      }, 50);
    });

    function closeModal() {
      modal.style.opacity = 0;
      setTimeout(() => {
        modal.style.display = 'none';
      }, 300);
    }
  </script>
</body>
</html>
