@extends('layouts.guest')
@section('title', 'Daftar Akun')

@section('content')
<div>
    <div class="mb-8">
        <p class="text-xs font-mono mb-3" style="color:#10B981; letter-spacing:0.1em;">// REGISTRASI BARU</p>
        <h2 style="font-size:2rem; font-weight:800; letter-spacing:-0.035em; color:#F1F5F9; line-height:1.15;">Buat Akun<br><span style="background:linear-gradient(135deg,#10B981,#06B6D4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">Masyarakat</span></h2>
        <p class="mt-2 text-sm" style="color:#475569;">Daftar menggunakan alamat email aktif Anda.</p>
    </div>

    <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="label-field">Email</label>
            <div class="relative">
                <input id="email" name="email" type="email" required autofocus
                       class="input-field"
                       placeholder="nama@email.com"
                       value="{{ old('email') }}">
            </div>
            @error('email')
                <p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="label-field">Nama Lengkap</label>
            <input id="name" name="name" type="text" required
                   class="input-field"
                   placeholder="Nama sesuai KTP"
                   value="{{ old('name') }}">
            @error('name')
                <p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="password" class="label-field">Password</label>
                <input id="password" name="password" type="password" required
                       class="input-field"
                       placeholder="Min. 6 karakter">
                @error('password')
                    <p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="label-field">Konfirmasi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="input-field"
                       placeholder="Ulangi password">
            </div>
        </div>

        <div class="pt-1 p-3 rounded-xl text-xs" style="background:rgba(6,182,212,0.06); border:1px solid rgba(6,182,212,0.12); color:#64748B; line-height:1.6;">
            <span style="color:#06B6D4; font-weight:600;">ⓘ Info:</span> Pastikan email yang Anda gunakan aktif untuk keperluan akses akun.
        </div>

        <div class="pt-1">
            <button type="submit" class="btn-primary w-full" style="padding:0.875rem; font-size:0.875rem; letter-spacing:0.02em;">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Buat Akun Sekarang
            </button>
        </div>
    </form>

    <div class="neon-divider mt-8"></div>

    <p class="text-center text-sm mt-6" style="color:#334155;">
        Sudah punya akun?
        <a href="{{ route('login') }}" style="color:#06B6D4; font-weight:600;"
           onmouseover="this.style.textDecoration='underline'"
           onmouseout="this.style.textDecoration='none'">
            Masuk di sini →
        </a>
    </p>
</div>
@endsection
