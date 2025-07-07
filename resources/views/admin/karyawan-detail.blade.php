@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Detail Karyawan: {{ $karyawan->name }}</h2>
            <a href="{{ route('admin.karyawan') }}" class="btn btn-secondary">Kembali</a>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Informasi Karyawan</h5>
                        <p><strong>Nama:</strong> {{ $karyawan->name }}</p>
                        <p><strong>Email:</strong> {{ $karyawan->email }}</p>
                        <p><strong>Tanggal Daftar:</strong> {{ $karyawan->created_at->format('d/m/Y') }}</p>
                        <p><strong>Total Absensi:</strong> {{ $karyawan->absensis->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Riwayat Absensi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                                     alt="Foto Absensi" class="img-thumbnail" style="width: 80px;">
                                            </td>
                                            <td>{{ $item->keterangan ?: '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data absensi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        {{ $absensi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection