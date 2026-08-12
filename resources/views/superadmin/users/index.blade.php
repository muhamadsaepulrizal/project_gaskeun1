@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="page-header flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// MANAJEMEN PENGGUNA</p>
        <h1 class="page-title">Daftar Pengguna</h1>
        <p class="page-subtitle">Tambah, edit, dan kelola hak akses seluruh pengguna sistem.</p>
    </div>
    <a href="{{ route('superadmin.users.create') }}" class="btn-primary shrink-0">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Pengguna
    </a>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Username / NIK</th>
                    <th>Hak Akses</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr x-data="{ openReset: false }">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold shrink-0"
                                 style="background:linear-gradient(135deg,rgba(16,185,129,0.2),rgba(6,182,212,0.2)); color:#06B6D4; border:1px solid rgba(6,182,212,0.15);">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-semibold" style="color:#CBD5E1;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span style="font-family:'JetBrains Mono',monospace; font-size:0.8125rem; color:#94A3B8;">{{ $user->username }}</span>
                    </td>
                    <td>
                        <span class="badge-info">{{ $user->roles->first()->name ?? 'Tanpa Role' }}</span>
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button @click="openReset = true" class="btn-edit" style="padding:0.375rem 0.75rem;">Reset PW</button>
                            <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn-edit" style="padding:0.375rem 0.75rem;">Edit</a>
                            <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus pengguna {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger" style="padding:0.375rem 0.75rem;">Hapus</button>
                            </form>
                        </div>

                        <!-- Reset Password Modal -->
                        <div x-show="openReset" x-cloak
                             class="fixed inset-0 z-50 flex items-center justify-center p-4"
                             style="background:rgba(0,0,0,0.7); backdrop-filter:blur(8px);">
                            <div @click.away="openReset = false"
                                 class="glass-card w-full max-w-md overflow-hidden"
                                 x-transition>
                                <form action="{{ route('superadmin.users.reset-password', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="px-6 py-4 flex justify-between items-center" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <div>
                                            <p class="text-xs" style="color:#06B6D4; font-family:monospace; letter-spacing:0.08em;">// RESET PASSWORD</p>
                                            <h3 class="font-bold text-sm mt-0.5" style="color:#F1F5F9;">{{ $user->name }}</h3>
                                        </div>
                                        <button type="button" @click="openReset = false" style="color:#334155;" onmouseover="this.style.color='#94A3B8'" onmouseout="this.style.color='#334155'">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                    <div class="p-6">
                                        <label class="label-field">Password Baru</label>
                                        <input type="password" name="password" required minlength="6"
                                               class="input-field mt-1"
                                               placeholder="Masukkan password baru (min. 6 karakter)">
                                    </div>
                                    <div class="px-6 pb-6 flex justify-end gap-3">
                                        <button type="button" @click="openReset = false" class="btn-secondary">Batal</button>
                                        <button type="submit" class="btn-primary">Simpan Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12" style="color:#334155;">
                        <svg class="w-8 h-8 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Belum ada pengguna terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-6 py-4" style="border-top:1px solid rgba(255,255,255,0.05);">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
