@extends('layouts.app')

@section('content')
<style>
    .card-glow {
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.15), 0 0 20px rgba(255, 165, 0, 0.15);
        border: none;
        border-radius: 1rem;
    }

    .gradient-header {
        background: linear-gradient(135deg, #007bff, #ffa500);
        color: white;
        font-weight: bold;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .form-label {
        font-weight: 500;
        color: #333;
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
</style>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-7">
        <div class="card card-glow">
            <div class="card-header gradient-header text-center">
                📌 Form Absensi Hari Ini
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('absensi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">📅 Tanggal</label>
                        <input type="text" class="form-control bg-light" value="{{ date('d/m/Y') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">⏰ Jam Masuk</label>
                        <input type="text" class="form-control bg-light" value="{{ date('H:i:s') }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📷 Foto <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                               name="foto" accept="image/*" required>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  name="keterangan" rows="3" placeholder="Tulis keterangan jika ada..."></textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-3 mt-4">
                        <button type="submit" class="btn btn-gradient btn-lg">
                            💾 Simpan Absensi
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            🔙 Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
