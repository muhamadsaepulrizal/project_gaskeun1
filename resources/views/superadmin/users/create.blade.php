@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#06B6D4; letter-spacing:0.1em;">// MANAJEMEN PENGGUNA</p>
        <h1 class="page-title">Tambah Pengguna Baru</h1>
        <p class="page-subtitle">Isi form di bawah untuk mendaftarkan akun pengguna baru.</p>
    </div>
    <a href="{{ route('superadmin.users.index') }}" class="btn-secondary">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="card p-8 max-w-2xl">
    <form action="{{ route('superadmin.users.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="label-field">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="input-field mt-1"
                       placeholder="Contoh: Budi Santoso">
                @error('name')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="label-field">Username / NIK</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="input-field mt-1"
                       placeholder="Username unik atau 16 digit NIK">
                @error('username')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="label-field">Password</label>
            <input type="password" name="password" required
                   class="input-field mt-1"
                   placeholder="Minimal 6 karakter">
            @error('password')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label-field">Hak Akses (Role)</label>
            <div class="relative mt-1">
                <select name="role" required class="select-field pr-10">
                    <option value="" style="background:#141E2E;">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" style="background:#141E2E;" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                    <svg class="w-4 h-4" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
            @error('role')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div class="pt-2 flex justify-end gap-3" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('superadmin.users.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Pengguna
            </button>
        </div>
    </form>
</div>
@endsection
