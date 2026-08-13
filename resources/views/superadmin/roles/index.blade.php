@extends('layouts.app')
@section('title', 'Role & Permission')

@section('content')
<div class="page-header">
    <p class="text-xs font-mono mb-1" style="color:#A78BFA; letter-spacing:0.1em;">// AKSES KONTROL</p>
    <h1 class="page-title">Role & Permission</h1>
    <p class="page-subtitle">Kelola hak akses dan izin untuk setiap role dalam sistem.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Roles -->
    <div class="card overflow-hidden">
        <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(255,255,255,0.05);">
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full" style="background:#A78BFA;"></div>
                <h3 class="font-semibold text-sm" style="color:#CBD5E1;">Daftar Role</h3>
            </div>
        </div>

        <!-- Add Role Form -->
        <div class="p-5" style="border-bottom:1px solid rgba(255,255,255,0.05);">
            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Tambah Role Baru</p>
            <form action="{{ route('superadmin.roles.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="name" required placeholder="Nama role baru..." class="input-field flex-1">
                <button type="submit" class="btn-primary shrink-0">Tambah</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table w-full">
                <thead><tr><th>Nama Role</th><th>Jumlah User</th><th>Aksi / Izin</th></tr></thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td class="font-medium align-top pt-4" style="color:#CBD5E1;">{{ $role->name }}</td>
                        <td class="align-top pt-4" style="color:#475569; font-family:'JetBrains Mono',monospace;">{{ $role->users_count ?? $role->users()->count() }}</td>
                        <td class="align-top pt-3 pb-3">
                            @if($role->name !== 'Super Admin')
                                <details class="group">
                                    <summary class="cursor-pointer text-xs font-semibold py-1 px-3 rounded" style="background: rgba(167, 139, 250, 0.1); border: 1px solid rgba(167, 139, 250, 0.3); color: #A78BFA; display: inline-block; list-style: none;">
                                        Atur Permission
                                    </summary>
                                    <div class="mt-3 p-4 rounded shadow-lg" style="background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(255,255,255,0.05); min-width: 250px;">
                                        <form action="{{ route('superadmin.roles.assign-permissions', $role) }}" method="POST">
                                            @csrf
                                            <p class="text-xs text-gray-400 mb-2">Pilih hak akses untuk role <strong>{{ $role->name }}</strong>:</p>
                                            <div class="flex flex-col gap-2 max-h-48 overflow-y-auto mb-3 pr-2">
                                                @forelse($permissions as $perm)
                                                    <label class="flex items-center gap-2 text-sm" style="color:#CBD5E1; cursor: pointer;">
                                                        <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" 
                                                            {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}
                                                            class="rounded" style="background: rgba(0,0,0,0.3); border-color: #475569;">
                                                        {{ $perm->name }}
                                                    </label>
                                                @empty
                                                    <p class="text-xs text-gray-500 italic">Belum ada permission dibuat.</p>
                                                @endforelse
                                            </div>
                                            <button type="submit" class="btn-primary w-full text-xs py-1.5" style="border-radius: 4px;">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </details>
                            @else
                                <span class="text-xs text-gray-500 italic">Akses Penuh</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center py-8" style="color:#334155;">Belum ada role.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Permissions -->
    <div class="card overflow-hidden">
        <div class="px-6 py-4 flex items-center gap-3" style="border-bottom:1px solid rgba(255,255,255,0.05);">
            <div class="w-2 h-2 rounded-full" style="background:#06B6D4;"></div>
            <h3 class="font-semibold text-sm" style="color:#CBD5E1;">Daftar Permission</h3>
        </div>

        <!-- Add Permission Form -->
        <div class="p-5" style="border-bottom:1px solid rgba(255,255,255,0.05);">
            <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#475569;">Tambah Permission Baru</p>
            <form action="{{ route('superadmin.permissions.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="name" required placeholder="Nama permission..." class="input-field flex-1">
                <button type="submit" class="btn-primary shrink-0">Tambah</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Nama Permission</th><th>Guard</th></tr></thead>
                <tbody>
                    @forelse($permissions as $perm)
                    <tr>
                        <td class="font-medium" style="color:#CBD5E1; font-family:'JetBrains Mono',monospace; font-size:0.8125rem;">{{ $perm->name }}</td>
                        <td><span class="badge-info">{{ $perm->guard_name }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-8" style="color:#334155;">Belum ada permission.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
