@extends('layouts.app')
@section('title', 'Dashboard Agen LPG')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// OPERASIONAL AGEN</p>
        <h1 class="page-title">Dashboard Agen LPG</h1>
        <p class="page-subtitle">Selamat datang, <span style="color:#10B981; font-weight:600;">{{ auth()->user()->username }}</span>. Kelola distribusi LPG ke pangkalan.</p>
    </div>
    <div class="text-xs font-mono px-3 py-1.5 rounded-lg" style="background:rgba(16,185,129,0.08); color:#10B981; border:1px solid rgba(16,185,129,0.15);">● ONLINE</div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Total Pengiriman</p>
                <p style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">{{ $totalPengiriman }}</p>
                <p class="text-xs mt-2" style="color:#475569;">Kali pengiriman</p>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.2);">
                <svg class="w-5 h-5" style="color:#06B6D4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Pangkalan Mitra</p>
                <p style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">{{ $totalPangkalan }}</p>
                <p class="text-xs mt-2" style="color:#475569;">Pangkalan aktif</p>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2);">
                <svg class="w-5 h-5" style="color:#10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Stok Gudang</p>
                <p style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">{{ number_format($stokTersedia) }}</p>
                <p class="text-xs mt-2" style="color:#475569;">Tabung tersedia</p>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.2);">
                <svg class="w-5 h-5" style="color:#F59E0B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
    </div>
</div>

<!-- CTA Card -->
<div class="card p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
     style="border-color:rgba(16,185,129,0.2); background:rgba(16,185,129,0.03);">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.08em;">// AKSI CEPAT</p>
        <h3 class="font-bold text-sm" style="color:#CBD5E1;">Catat Pengiriman LPG Baru</h3>
        <p class="text-sm mt-1" style="color:#475569;">Input data pengiriman ke pangkalan secara manual atau via import Excel.</p>
    </div>
    <div class="flex gap-3 shrink-0">
        <a href="{{ route('agen.pengiriman.status') }}" class="btn-secondary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            Lihat Status
        </a>
        <a href="{{ route('agen.pengiriman.create') }}" class="btn-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Input Pengiriman
        </a>
    </div>
</div>
@endsection
