@extends('layouts.app')
@section('title', 'Dashboard Executive — Pimpinan Daerah')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.color = '#64748B';
Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

document.addEventListener('DOMContentLoaded', function() {
    // Konsumsi Chart
    const konsumsiData = {!! json_encode(array_values($grafikKonsumsi)) !!};
    const konsumsiLabels = {!! json_encode(array_keys($grafikKonsumsi)) !!};
    new Chart(document.getElementById('konsumsiChart'), {
        type: 'line',
        data: {
            labels: konsumsiLabels,
            datasets: [{
                label: 'Konsumsi (Tabung)',
                data: konsumsiData,
                borderColor: '#06B6D4',
                backgroundColor: 'rgba(6,182,212,0.05)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#06B6D4',
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { font: { family: 'Space Grotesk', size: 11 } } },
                y: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { font: { family: 'Space Grotesk', size: 11 } } }
            }
        }
    });

    // Keluhan Chart
    const keluhanData = {!! json_encode(array_values($grafikKeluhan)) !!};
    const keluhanLabels = {!! json_encode(array_keys($grafikKeluhan)) !!};
    new Chart(document.getElementById('keluhanChart'), {
        type: 'bar',
        data: {
            labels: keluhanLabels,
            datasets: [{
                label: 'Keluhan',
                data: keluhanData,
                backgroundColor: 'rgba(244,63,94,0.2)',
                borderColor: '#F43F5E',
                borderWidth: 1,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { family: 'Space Grotesk', size: 11 } } },
                y: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { font: { family: 'Space Grotesk', size: 11 } } }
            }
        }
    });
});
</script>
@endpush

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// EXECUTIVE DASHBOARD</p>
        <h1 class="page-title">Ringkasan Eksekutif</h1>
        <p class="page-subtitle">Monitoring distribusi LPG bersubsidi wilayah — baca saja, real-time.</p>
    </div>
    <div class="text-xs font-mono px-3 py-1.5 rounded-lg" style="background:rgba(16,185,129,0.08); color:#10B981; border:1px solid rgba(16,185,129,0.15);">
        ● LIVE
    </div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Total Penyaluran</p>
        <p style="font-size:1.75rem; font-weight:800; color:#06B6D4; letter-spacing:-0.03em;">{{ $totalPenyaluran }}</p>
        <p class="text-xs mt-1" style="color:#334155;">Tabung</p>
    </div>
    <div class="stat-card">
        <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">LPG Masuk</p>
        <p style="font-size:1.75rem; font-weight:800; color:#10B981; letter-spacing:-0.03em;">{{ $totalLpgMasuk }}</p>
        <p class="text-xs mt-1" style="color:#334155;">Tabung</p>
    </div>
    <div class="stat-card">
        <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Rekomendasi Kuota</p>
        <p style="font-size:1.75rem; font-weight:800; color:#F59E0B; letter-spacing:-0.03em;">{{ $rekomendasiKuota }}</p>
        <p class="text-xs mt-1" style="color:#334155;">Tabung</p>
    </div>
    <div class="stat-card">
        <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Efektivitas Agen</p>
        <p style="font-size:1.75rem; font-weight:800; color:#A78BFA; letter-spacing:-0.03em;">{{ $efektivitasAgen }}</p>
        <p class="text-xs mt-1" style="color:#334155;">Rate</p>
    </div>
</div>

<!-- Charts + Side Panel -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <!-- Left: Charts -->
    <div class="lg:col-span-2 space-y-5">
        <div class="card p-6">
            <h3 class="text-sm font-semibold mb-4" style="color:#94A3B8;">Grafik Konsumsi Bulanan</h3>
            <div style="height:200px;">
                <canvas id="konsumsiChart"></canvas>
            </div>
        </div>
        <div class="card p-6">
            <h3 class="text-sm font-semibold mb-4" style="color:#94A3B8;">Trend Keluhan Masyarakat</h3>
            <div style="height:180px;">
                <canvas id="keluhanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right: Status -->
    <div class="space-y-5">
        <div class="card p-6">
            <h3 class="text-sm font-semibold mb-4" style="color:#94A3B8;">Status Kecamatan</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-xl" style="background:rgba(244,63,94,0.06); border:1px solid rgba(244,63,94,0.1);">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full" style="background:#F43F5E; box-shadow:0 0 6px rgba(244,63,94,0.8);"></div>
                        <span class="text-sm font-medium" style="color:#FDA4AF;">Krisis</span>
                    </div>
                    <span class="font-bold" style="color:#F43F5E;">{{ $statusKecamatan['Krisis'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl" style="background:rgba(245,158,11,0.06); border:1px solid rgba(245,158,11,0.1);">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full" style="background:#F59E0B; box-shadow:0 0 6px rgba(245,158,11,0.8);"></div>
                        <span class="text-sm font-medium" style="color:#FCD34D;">Waspada</span>
                    </div>
                    <span class="font-bold" style="color:#F59E0B;">{{ $statusKecamatan['Waspada'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 rounded-xl" style="background:rgba(16,185,129,0.06); border:1px solid rgba(16,185,129,0.1);">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2 h-2 rounded-full" style="background:#10B981; box-shadow:0 0 6px rgba(16,185,129,0.8);"></div>
                        <span class="text-sm font-medium" style="color:#6EE7B7;">Aman</span>
                    </div>
                    <span class="font-bold" style="color:#10B981;">{{ $statusKecamatan['Aman'] }}</span>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="text-sm font-semibold mb-4" style="color:#94A3B8;">Kecamatan Bermasalah</h3>
            <div class="space-y-2">
                @foreach($rangkingMasalah as $index => $masalah)
                <div class="flex items-center gap-3 p-2.5 rounded-xl" style="background:rgba(255,255,255,0.02);">
                    <span class="w-5 h-5 rounded-md flex items-center justify-center text-xs font-bold shrink-0" style="background:rgba(244,63,94,0.15); color:#F43F5E;">#{{ $index + 1 }}</span>
                    <span class="text-xs font-medium flex-1" style="color:#94A3B8;">{{ $masalah['kecamatan'] }}</span>
                    <span class="text-xs font-bold" style="color:#F43F5E;">{{ $masalah['kasus'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
