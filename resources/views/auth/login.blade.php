@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<div>
    <div class="mb-8">
        <p class="text-xs font-mono mb-3" style="color:#06B6D4; letter-spacing:0.1em;">// SELAMAT DATANG</p>
        <h2 style="font-size:2rem; font-weight:800; letter-spacing:-0.035em; color:#F1F5F9; line-height:1.15;">Masuk ke Sistem<br><span style="background:linear-gradient(135deg,#10B981,#06B6D4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">GASKEUN</span></h2>
        <p class="mt-2 text-sm" style="color:#475569;">Gunakan username atau NIK dan password akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
        @csrf

        <div>
            <label for="username" class="label-field">NIK / Username</label>
            <input id="username" name="username" type="text" required autofocus
                   class="input-field"
                   placeholder="Masukkan NIK atau username Anda"
                   value="{{ old('username') }}">
            @error('username')
                <p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="label-field">Password</label>
            <input id="password" name="password" type="password" required
                   class="input-field"
                   placeholder="Masukkan password Anda">
            @error('password')
                <p class="mt-1.5 text-xs" style="color:#F43F5E;">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2 pt-1">
            <input id="remember" name="remember" type="checkbox"
                   style="width:1rem; height:1rem; accent-color:#06B6D4; border-radius:0.25rem;">
            <label for="remember" class="text-sm" style="color:#475569; cursor:pointer;">Ingat saya</label>
        </div>

        <div class="pt-2">
            <button type="submit" class="btn-primary w-full" style="padding:0.875rem; font-size:0.875rem; letter-spacing:0.02em;">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Masuk ke Sistem
            </button>
        </div>
    </form>

    <div class="neon-divider mt-8"></div>

    <p class="text-center text-sm mt-6" style="color:#334155;">
        Belum punya akun?
        <a href="{{ route('register') }}" style="color:#06B6D4; font-weight:600;"
           onmouseover="this.style.textDecoration='underline'"
           onmouseout="this.style.textDecoration='none'">
            Daftar sekarang →
        </a>
    </p>
</div>
@endsection
