@extends('layouts.app')

@section('content')
<style>
    .card-glow {
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.1), 0 0 15px rgba(255, 165, 0, 0.1);
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

    .table thead {
        background: linear-gradient(90deg, #007bff 0%, #ffa500 100%);
        color: white;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .img-thumbnail {
        border-radius: 0.5rem;
        border: 2px solid #007bff33;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="mb-2 fw-bold text-primary">📋 Riwayat Absensi Saya</h2>
            <a href="{{ route('absensi.create') }}" class="btn btn-gradient btn-lg mb-2">📍 Absen Hari Ini</a>
        </div>

        <div class="card card-glow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle text-center">
                        <thead>
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
                                             alt="Foto Absensi" class="img-thumbnail" style="width: 90px;">
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
                <div class="mt-4">
                    {{ $absensi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
