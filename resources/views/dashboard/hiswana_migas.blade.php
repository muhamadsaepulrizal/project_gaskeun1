@extends('layouts.app')
@section('title', 'Monitoring Hiswana Migas')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// DASHBOARD OVERVIEW</p>
        <h1 class="page-title">Monitoring Hiswana Migas</h1>
        <p class="page-subtitle">Pantau kinerja distribusi dan operasional Agen & Pangkalan.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Agen Aktif Menyalurkan</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">42 <span class="text-sm font-medium ml-2" style="color:#10B981;">↑ 5%</span></p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2);">
                <svg class="w-5 h-5" style="color:#10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Pangkalan Bermasalah (Koreksi)</p>
                <p style="font-size:2rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">3 <span class="text-sm font-medium ml-2" style="color:#F43F5E;">Perlu Tinjauan</span></p>
            </div>
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(244,63,94,0.1); border:1px solid rgba(244,63,94,0.2);">
                <svg class="w-5 h-5" style="color:#F43F5E;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        </div>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="px-6 py-4 flex justify-between items-center" style="border-bottom:1px solid rgba(255,255,255,0.05); background:rgba(255,255,255,0.02);">
        <h3 class="text-xs font-bold uppercase tracking-wider" style="color:#94A3B8;">Logistik Pengiriman Terakhir (Dummy)</h3>
        <button class="text-xs font-medium" style="color:#10B981;">Lihat Semua</button>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Agen Pengirim</th>
                    <th>Pangkalan Tujuan</th>
                    <th class="text-center">Jumlah (Tabung)</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-medium" style="color:#CBD5E1;">Agen Berkah Makmur</td>
                    <td style="color:#94A3B8;">Pangkalan Pak Budi</td>
                    <td class="text-center font-bold" style="color:#06B6D4;">560</td>
                    <td class="text-center"><span class="badge-active">Selesai</span></td>
                </tr>
                <tr>
                    <td class="font-medium" style="color:#CBD5E1;">Agen Sejahtera</td>
                    <td style="color:#94A3B8;">Pangkalan Bu Tejo</td>
                    <td class="text-center font-bold" style="color:#06B6D4;">300</td>
                    <td class="text-center"><span class="badge-pending">Dalam Proses</span></td>
                </tr>
                <tr>
                    <td class="font-medium" style="color:#CBD5E1;">Agen Gas Kita</td>
                    <td style="color:#94A3B8;">Pangkalan Sinar Jaya</td>
                    <td class="text-center font-bold" style="color:#06B6D4;">150</td>
                    <td class="text-center"><span class="badge-danger">Dikoreksi</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
