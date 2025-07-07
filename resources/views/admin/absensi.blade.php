@extends('layouts.app')

@section('content')
<style>
    .card-header-custom {
        background: linear-gradient(to right, #007bff, #00c6ff);
        color: white;
        padding: 1rem 1.25rem;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .filter-box {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-primary {
        background: linear-gradient(to right, #0066cc, #3399ff);
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-primary:hover, .btn-secondary:hover {
        opacity: 0.9;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4 text-primary fw-bold">📋 Data Absensi Karyawan</h2>

        <!-- Filter Form -->
        <div class="filter-box shadow-sm">
            <form method="GET" action="{{ route('admin.absensi') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                               value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Karyawan</label>
                        <select name="karyawan" class="form-select">
                            <option value="">Semua Karyawan</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}" {{ request('karyawan') == $k->id ? 'selected' : '' }}>
                                    {{ $k->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('admin.absensi') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="card shadow">
            <div class="card-header-custom">
                <h5 class="mb-0 fw-bold">📊 Tabel Absensi</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensi as $item)
                                <tr class="text-center align-middle">
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                    <td>{{ $item->jam_masuk }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/absensi/' . $item->foto) }}"
                                            alt="Foto Absensi" class="img-thumbnail rounded"
                                            style="width: 90px; height: 90px; object-fit: cover; cursor: pointer;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#fotoModal"
                                            data-foto="{{ asset('uploads/absensi/' . $item->foto) }}">
                                        </td>
                                    <td>{{ $item->keterangan ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <em>Tidak ada data absensi</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($absensi->hasPages())
                <div class="card-footer text-center py-3">
                    {{ $absensi->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fotoModalLabel">Foto Absen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" id="modalFoto" class="img-fluid rounded" alt="Foto Absen">
      </div>
    </div>
  </div>
</div>
<script>
    const fotoModal = document.getElementById('fotoModal');
    fotoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const fotoSrc = button.getAttribute('data-foto');
        const modalImg = document.getElementById('modalFoto');
        modalImg.src = fotoSrc;
    });
</script>
