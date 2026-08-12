@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// MANAJEMEN PENGGUNA</p>
        <h1 class="page-title">Edit Pengguna</h1>
        <p class="page-subtitle">Perbarui informasi dan hak akses untuk <span style="color:#CBD5E1;">{{ $user->name }}</span>.</p>
    </div>
    <a href="{{ route('superadmin.users.index') }}" class="btn-secondary">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="card p-8 max-w-2xl">
    <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="label-field">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="input-field mt-1"
                       placeholder="Nama lengkap">
                @error('name')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="label-field">Username / NIK</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                       class="input-field mt-1"
                       placeholder="Username atau NIK">
                @error('username')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="label-field">Hak Akses (Role)</label>
            <div class="relative mt-1">
                <select name="role" required class="select-field pr-10">
                    <option value="" style="background:#141E2E;">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" style="background:#141E2E;"
                                {{ (old('role') ?? ($user->roles->first()->name ?? '')) == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                    <svg class="w-4 h-4" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
            @error('role')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div class="p-4 rounded-xl" style="background:rgba(6,182,212,0.04); border:1px solid rgba(6,182,212,0.1);">
            <p class="text-xs" style="color:#475569;">
                <span style="color:#06B6D4; font-weight:600;">ⓘ Info:</span>
                Untuk mengganti password pengguna ini, gunakan fitur "Reset Password" di halaman daftar pengguna.
            </p>
        </div>

        <div class="pt-2 flex justify-end gap-3" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('superadmin.users.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Update Pengguna
            </button>
        </div>
    </form>
</div>
@endsection
