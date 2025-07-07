@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Detail Karyawan</h2>
        <a href="{{ route('admin.karyawan') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <!-- Informasi Karyawan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4 text-secondary">Informasi Karyawan</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nama:</strong> {{ $karyawan->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $karyawan->email }}</li>
                        <li class="list-group-item"><strong>Tanggal Daftar:</strong> {{ $karyawan->created_at->format('d/m/Y') }}</li>
                        <li class="list-group-item"><strong>Total Absensi:</strong> {{ $karyawan->absensis->count() }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Riwayat Absensi -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Riwayat Absensi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensi as $item)
                                    <tr>
                                        <td>{{ date('d/m/Y', strtotime($item->tanggal)) }}</td>
                                        <td>{{ $item->jam_masuk }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/absensi/' . $item->foto) }}" 
                                                alt="Foto Absensi" class="img-thumbnail rounded"
                                                style="width: 80px; cursor: pointer;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#fotoModal"
                                                data-foto="{{ asset('uploads/absensi/' . $item->foto) }}">
                                        </td>
                                        <td>{{ $item->keterangan ?: '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted">Belum ada data absensi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $absensi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fotoModalLabel">Foto Absensi</h5>
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

@endsection
