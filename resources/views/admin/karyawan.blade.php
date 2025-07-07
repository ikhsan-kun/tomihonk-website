@extends('layouts.app')

@section('content')
<style>
    .card-custom {
        border-radius: 1rem;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.1), 0 0 20px rgba(255, 193, 7, 0.1);
    }

    .table thead {
        background: linear-gradient(90deg, #003366, #00bfff, #FFD700);
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f2f9ff;
    }

    .btn-info {
        background-color: #00bfff;
        border: none;
        color: white;
    }

    .btn-info:hover {
        background-color: #009acd;
    }

    h2 {
        color: #003366;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .pagination {
        justify-content: center;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <h2>📋Data Karyawan</h2>

        <div class="card card-custom">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Daftar</th>
                                <th>Total Absensi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($karyawan as $index => $k)
                                <tr>
                                    <td>{{ $karyawan->firstItem() + $index }}</td>
                                    <td>{{ $k->name }}</td>
                                    <td>{{ $k->email }}</td>
                                    <td>{{ $k->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $k->absensis->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.karyawan.detail', $k->id) }}" 
                                           class="btn btn-sm btn-info">🔍 Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data karyawan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $karyawan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
