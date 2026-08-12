@extends('layouts.app')
@section('title', 'Dashboard Super Admin')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// SUPER ADMIN</p>
        <h1 class="page-title">Panel Manajemen Sistem</h1>
        <p class="page-subtitle">Selamat datang, <span style="color:#06B6D4; font-weight:600;">{{ auth()->user()->username }}</span>. Kelola keamanan dan akses GASKEUN dari sini.</p>
    </div>
    <div class="text-xs font-mono px-3 py-1.5 rounded-lg" style="background:rgba(16,185,129,0.08); color:#10B981; border:1px solid rgba(16,185,129,0.15);">
        ● ONLINE
    </div>
</div>

<!-- KPI Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Total Pengguna</p>
                <p style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">{{ $totalUsers }}</p>
                <p class="text-xs mt-2" style="color:#475569;">Akun terdaftar di sistem</p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.2);">
                <svg class="w-6 h-6" style="color:#06B6D4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
        <div class="mt-4 pt-4" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('superadmin.users.index') }}" class="text-xs font-semibold transition-colors" style="color:#475569;"
               onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#475569'">
                Lihat semua pengguna →
            </a>
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Total Roles</p>
                <p style="font-size:2.5rem; font-weight:800; line-height:1; color:#F1F5F9; letter-spacing:-0.03em;">{{ $totalRoles }}</p>
                <p class="text-xs mt-2" style="color:#475569;">Hak akses tersedia</p>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2);">
                <svg class="w-6 h-6" style="color:#10B981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
        </div>
        <div class="mt-4 pt-4" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('superadmin.roles.index') }}" class="text-xs font-semibold transition-colors" style="color:#475569;"
               onmouseover="this.style.color='#10B981'" onmouseout="this.style.color='#475569'">
                Kelola roles & permissions →
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4" style="border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="flex items-center gap-3">
            <div class="w-2 h-2 rounded-full animate-glow-pulse" style="background:#06B6D4;"></div>
            <h3 class="font-semibold text-sm" style="color:#CBD5E1;">Log Aktivitas Sistem Terkini</h3>
        </div>
        <a href="{{ route('superadmin.logs.index') }}" class="text-xs font-semibold transition-colors" style="color:#475569;"
           onmouseover="this.style.color='#06B6D4'" onmouseout="this.style.color='#475569'">
            Lihat semua →
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="text-left">User</th>
                    <th class="text-left">Aktivitas</th>
                    <th class="text-left">Event</th>
                    <th class="text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLogs as $log)
                <tr>
                    <td>
                        <span class="font-semibold" style="color:#CBD5E1;">{{ $log->causer->username ?? 'Sistem' }}</span>
                    </td>
                    <td style="color:#94A3B8;">{{ $log->description }}</td>
                    <td>
                        <span class="badge-info">{{ $log->event ?? 'log' }}</span>
                    </td>
                    <td style="color:#475569; font-family:'JetBrains Mono',monospace; font-size:0.75rem;">{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12" style="color:#334155;">
                        <svg class="w-8 h-8 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Belum ada riwayat aktivitas sistem.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
