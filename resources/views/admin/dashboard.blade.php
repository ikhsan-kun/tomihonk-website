@extends('layouts.app')

@section('content')
<style>
    .card-metric {
        border-radius: 0.75rem;
        color: white;
        overflow: hidden;
    }

    canvas {
        margin-top: 10px;
        height: 30px !important;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4 text-primary fw-bold">Admin Dashboard</h2>

        <div class="row g-3 mb-4">
            <!-- Total Karyawan (Biru Tua) -->
            <div class="col-md-4">
                <div class="card card-metric" style="background-color: #003f88;">
                    <div class="card-body">
                        <div class="fs-4 fw-bold">{{ $totalKaryawan }}</div>
                        <div class="small">Total Karyawan</div>
                        <canvas id="chart-karyawan"></canvas>
                    </div>
                </div>
            </div>

            <!-- Total Absensi (Biru Muda) -->
            <div class="col-md-4">
                <div class="card card-metric" style="background-color: #2196f3;">
                    <div class="card-body">
                        <div class="fs-4 fw-bold">{{ $totalAbsensi }}</div>
                        <div class="small">Total Absensi</div>
                        <canvas id="chart-absensi-total"></canvas>
                    </div>
                </div>
            </div>

            <!-- Absen Hari Ini (Kuning) -->
            <div class="col-md-4">
                <div class="card card-metric" style="background-color: #fcbf1e;">
                    <div class="card-body">
                        <div class="fs-4 fw-bold">{{ $absenHariIni }}</div>
                        <div class="small">Absen Hari Ini</div>
                        <canvas id="chart-absen"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Admin -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold text-primary">Menu Admin</h5>
                        <a href="{{ route('admin.absensi') }}" class="btn btn-primary d-block mb-2">
                            Lihat Semua Absensi
                        </a>
                        <a href="{{ route('admin.karyawan') }}" class="btn btn-secondary d-block">
                            Kelola Karyawan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const makeChart = (id) => {
            const ctx = document.getElementById(id);
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['', '', '', '', '', '', ''],
                    datasets: [{
                        data: [20, 35, 30, 50, 45, 60, 40],
                        borderColor: 'rgba(255, 255, 255, 1)',
                        backgroundColor: 'rgba(255, 255, 255, 0.2)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        line: { borderWidth: 2 }
                    }
                }
            });
        };

        makeChart('chart-karyawan');
        makeChart('chart-absen');
        makeChart('chart-absensi-total');
    });
</script>
@endpush
