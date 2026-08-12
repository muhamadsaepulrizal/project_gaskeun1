@extends('layouts.app')
@section('title', 'Dashboard Pangkalan LPG')

@section('content')
<div class="page-header flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// OPERASIONAL PANGKALAN</p>
        <h1 class="page-title">Dashboard Operasional Pangkalan</h1>
        <p class="page-subtitle">Selamat datang, <span style="color:#10B981; font-weight:600;">{{ auth()->user()->username }}</span>. Kelola penerimaan dan penyaluran LPG.</p>
    </div>
    
    <!-- Real-time Stock Badge -->
    <div class="shrink-0 flex items-center px-5 py-3 rounded-2xl" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3);">
        <div class="p-2 rounded-full mr-3" style="background:rgba(16,185,129,0.2); color:#10B981;">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <div>
            <p class="text-xs font-bold uppercase tracking-wider" style="color:#10B981;">Sisa Stok Saat Ini</p>
            <h2 style="font-size:1.75rem; font-weight:900; line-height:1; color:#F1F5F9;">{{ $stokTersedia }} <span class="text-sm font-normal" style="color:#94A3B8;">Tabung</span></h2>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
    <div class="stat-card flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#475569;">Total Diterima (Bulan Ini)</p>
            <h2 style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9;">{{ $totalPenerimaan }}</h2>
        </div>
        <div class="p-3 rounded-xl" style="background:rgba(59,130,246,0.1); color:#3B82F6; border:1px solid rgba(59,130,246,0.2);">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
        </div>
    </div>

    <div class="stat-card flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-2" style="color:#475569;">Total Disalurkan (Bulan Ini)</p>
            <h2 style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9;">{{ $totalPenyaluran }}</h2>
        </div>
        <div class="p-3 rounded-xl" style="background:rgba(245,158,11,0.1); color:#F59E0B; border:1px solid rgba(245,158,11,0.2);">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="card p-6 flex flex-col justify-between" style="border-color:rgba(59,130,246,0.2); background:rgba(59,130,246,0.03);">
        <div class="mb-5">
            <h3 class="font-bold text-sm" style="color:#3B82F6;">Terima Barang dari Agen</h3>
            <p class="text-sm mt-1" style="color:#94A3B8;">Konfirmasi penerimaan tabung LPG dari agen atau ajukan koreksi jika jumlah tidak sesuai.</p>
        </div>
        <a href="{{ route('pangkalan.pengiriman.index') }}" class="btn-primary w-full justify-center" style="background:#3B82F6;">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Cek Penerimaan
        </a>
    </div>

    <div class="card p-6 flex flex-col justify-between" style="border-color:rgba(245,158,11,0.2); background:rgba(245,158,11,0.03);">
        <div class="mb-5">
            <h3 class="font-bold text-sm" style="color:#F59E0B;">Salurkan LPG ke Warga</h3>
            <p class="text-sm mt-1" style="color:#94A3B8;">Catat penyaluran LPG bersubsidi ke masyarakat yang berhak (berdasarkan NIK/Scan KTP).</p>
        </div>
        <a href="{{ route('pangkalan.penyaluran.create') }}" class="btn-primary w-full justify-center" style="background:#F59E0B;">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Form Penyaluran
        </a>
    </div>
</div>
@endsection
