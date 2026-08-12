@extends('layouts.app')
@section('title', 'Profil Agen')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <p class="text-xs font-mono mb-1" style="color:#10B981; letter-spacing:0.1em;">// PROFIL SAYA</p>
        <h1 class="page-title">Profil Agen</h1>
        <p class="page-subtitle">Perbarui informasi dan data kontak agen Anda.</p>
    </div>
</div>

<div class="card p-8 max-w-2xl">
    <form action="{{ route('agen.profil.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="label-field">Nama Agen</label>
            <input type="text" name="nama_agen" value="{{ old('nama_agen', $profil->nama_agen) }}" required
                   class="input-field mt-1" placeholder="Nama resmi agen LPG">
            @error('nama_agen')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label-field">No. Registrasi</label>
            <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $profil->no_registrasi) }}"
                   class="input-field mt-1" style="font-family:'JetBrains Mono',monospace; letter-spacing:0.05em;"
                   placeholder="Nomor registrasi resmi agen">
            @error('no_registrasi')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label-field">Alamat Agen</label>
            <textarea name="alamat" rows="3" class="input-field mt-1"
                      placeholder="Alamat lengkap agen LPG">{{ old('alamat', $profil->alamat) }}</textarea>
            @error('alamat')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="label-field">Nomor Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $profil->kontak) }}"
                   class="input-field mt-1" placeholder="Nomor telepon / WhatsApp">
            @error('kontak')<p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>@enderror
        </div>

        <div class="pt-2 flex justify-end gap-3" style="border-top:1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('agen.dashboard') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Profil
            </button>
        </div>
    </form>
</div>
@endsection
