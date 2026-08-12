@extends('layouts.app')
@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="page-header">
    <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// AUDIT TRAIL</p>
    <h1 class="page-title">Log Aktivitas Sistem</h1>
    <p class="page-subtitle">Rekam jejak seluruh aktivitas pengguna dalam sistem GASKEUN.</p>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>Event</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="color:#475569; font-family:'JetBrains Mono',monospace; font-size:0.75rem; white-space:nowrap;">
                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                    </td>
                    <td>
                        <span class="font-semibold text-sm" style="color:#CBD5E1;">{{ $log->causer->username ?? 'Sistem' }}</span>
                        @if($log->causer)
                            <p class="text-xs" style="color:#334155;">{{ $log->causer->roles->first()->name ?? '' }}</p>
                        @endif
                    </td>
                    <td style="color:#94A3B8; max-width:260px;">
                        <span class="text-sm">{{ $log->description }}</span>
                    </td>
                    <td>
                        @php
                            $cls = match($log->event) {
                                'created' => 'badge-active',
                                'updated' => 'badge-info',
                                'deleted' => 'badge-danger',
                                default   => 'badge-pending',
                            };
                        @endphp
                        <span class="{{ $cls }}">{{ $log->event ?? 'log' }}</span>
                    </td>
                    <td style="color:#475569; font-size:0.75rem; font-family:'JetBrains Mono',monospace;">
                        {{ class_basename($log->subject_type ?? '') }}
                        @if($log->subject_id) <span style="color:#334155;">#{{ $log->subject_id }}</span> @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12" style="color:#334155;">
                        <svg class="w-8 h-8 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Belum ada riwayat aktivitas sistem.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($logs) && method_exists($logs, 'hasPages') && $logs->hasPages())
    <div class="px-6 py-4" style="border-top:1px solid rgba(255,255,255,0.05);">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
