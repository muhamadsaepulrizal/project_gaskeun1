@extends('layouts.app')
@section('title', 'Dashboard Disperindag')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// DASHBOARD OVERVIEW</p>
        <h1 class="page-title">Dashboard Disperindag</h1>
        <p class="page-subtitle">Rekapitulasi data master sasaran dan tren penyaluran harian.</p>
    </div>
</div>

<!-- Database Metrics -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Total UMKM</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">1,240</p>
                <p class="text-xs mt-2" style="color:#3B82F6;">Berdasarkan verifikasi</p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(59,130,246,0.1); border:1px solid rgba(59,130,246,0.2);">
                <svg class="w-5 h-5" style="color:#3B82F6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Rumah Tangga</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">15,300</p>
                <p class="text-xs mt-2" style="color:#10B981;">Data DTKS Kemensos</p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2);">
                <svg class="w-5 h-5" style="color:#10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Nelayan</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">842</p>
                <p class="text-xs mt-2" style="color:#6366F1;">Penerima Kartu Kusuka</p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.2);">
                <svg class="w-5 h-5" style="color:#6366F1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Petani</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">2,105</p>
                <p class="text-xs mt-2" style="color:#F59E0B;">Kelompok Terverifikasi</p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2);">
                <svg class="w-5 h-5" style="color:#F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- Chart Area (Placeholder) -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-sm" style="color:#CBD5E1;">Tren Penyaluran LPG 3Kg (Bulan Ini)</h3>
        <select class="select-field" style="width:180px; padding-top:0.375rem; padding-bottom:0.375rem;">
            <option style="background:#141E2E;">Semua Kategori</option>
            <option style="background:#141E2E;">UMKM</option>
            <option style="background:#141E2E;">Rumah Tangga</option>
        </select>
    </div>
    
    <div class="w-full h-64 rounded-xl flex items-center justify-center" style="background:rgba(255,255,255,0.02); border:1px dashed rgba(255,255,255,0.1);">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 mb-3" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
            <p class="text-sm font-medium" style="color:#94A3B8;">Area Visualisasi Grafik (Chart.js / ApexCharts)</p>
            <p class="text-xs mt-1" style="color:#64748B;">Data akan diload secara dinamis dari API.</p>
        </div>
    </div>
</div>
@endsection
