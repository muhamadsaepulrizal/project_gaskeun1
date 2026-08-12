<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASKEUN — @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body style="background-color:#080C14; color:#F1F5F9; font-family:'Space Grotesk',sans-serif;" class="antialiased h-screen overflow-hidden flex"
      x-data="{ sidebarOpen: false, userMenu: false }">

    <!-- ═══════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════ -->
    <aside class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300 md:translate-x-0 md:static md:inset-0"
           :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
           style="background:#060A10; border-right:1px solid rgba(255,255,255,0.05);">

        <!-- Logo -->
        <div class="h-16 flex items-center px-5" style="border-bottom:1px solid rgba(255,255,255,0.05);">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#10B981,#06B6D4); box-shadow:0 0 16px rgba(6,182,212,0.4);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <span style="font-weight:800; font-size:1.125rem; letter-spacing:-0.025em; color:#F1F5F9;">GASKEUN<span style="color:#06B6D4;">.</span></span>
            </div>
        </div>

        <!-- Nav Items -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

            <!-- Dashboard -->
            <a href="/dashboard" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <!-- ─── Super Admin ─── -->
            @role('Super Admin')
            <p class="nav-section-label">Manajemen Sistem</p>
            <a href="{{ route('superadmin.users.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Kelola Pengguna
            </a>
            <a href="{{ route('superadmin.roles.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Role & Permission
            </a>
            <a href="{{ route('superadmin.logs.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Log Aktivitas
            </a>
            @endrole

            <!-- ─── Disperindag ─── -->
            @role('Disperindag')
            <p class="nav-section-label">Master Data</p>
            <a href="{{ route('disperindag.kecamatans.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                Kecamatan
            </a>
            <a href="{{ route('disperindag.desas.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Desa / Kelurahan
            </a>
            <a href="{{ route('disperindag.kks.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Kartu Keluarga
            </a>
            <a href="{{ route('disperindag.penduduks.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Penduduk
            </a>
            <a href="{{ route('disperindag.nelayans.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                Nelayan
            </a>
            <a href="{{ route('disperindag.petanis.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Petani
            </a>
            <a href="{{ route('disperindag.umkms.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                UMKM
            </a>
            <a href="{{ route('disperindag.rts.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Rumah Tangga Sasaran
            </a>
            <p class="nav-section-label">Layanan</p>
            <a href="{{ route('disperindag.keluhan.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                Kelola Keluhan
            </a>
            @endrole

            <!-- ─── Agen LPG ─── -->
            @role('Agen LPG')
            <p class="nav-section-label">Distribusi</p>
            <a href="{{ route('agen.profil') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Agen
            </a>
            <a href="{{ route('agen.pengiriman.create') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Input Pengiriman
            </a>
            <a href="{{ route('agen.pengiriman.status') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Status Pengiriman
            </a>
            @endrole

            <!-- ─── Pangkalan LPG ─── -->
            @role('Pangkalan LPG')
            <p class="nav-section-label">Stok & Distribusi</p>
            <a href="{{ route('pangkalan.pengiriman.index') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                Terima LPG
            </a>
            <a href="{{ route('pangkalan.penyaluran.create') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                Salurkan LPG
            </a>
            <a href="{{ route('pangkalan.stok') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Monitoring Stok
            </a>
            @endrole

            <!-- ─── Publik ─── -->
            @role('Publik')
            <p class="nav-section-label">Layanan Publik</p>
            <a href="{{ route('public.peta') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                Peta Pangkalan
            </a>
            <a href="{{ route('public.heatmap') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Heatmap Kelangkaan
            </a>
            <a href="{{ route('public.keluhan.create') }}" class="nav-link">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Kirim Keluhan
            </a>
            @endrole

        </nav>

        <!-- User Info at Bottom -->
        <div class="p-3" style="border-top:1px solid rgba(255,255,255,0.05);">
            <div class="flex items-center gap-3 p-2 rounded-xl" style="background:rgba(255,255,255,0.03);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-sm font-bold" style="background:linear-gradient(135deg,#10B981,#06B6D4); color:white;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-semibold truncate" style="color:#CBD5E1;">{{ auth()->user()->name }}</p>
                    <p class="text-xs truncate" style="color:#475569;">{{ auth()->user()->roles->first()->name ?? 'User' }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" x-transition.opacity
         class="fixed inset-0 z-40 md:hidden"
         style="background:rgba(0,0,0,0.6); backdrop-filter:blur(4px);"
         @click="sidebarOpen = false"></div>

    <!-- ═══════════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════════ -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar -->
        <header class="h-16 flex items-center justify-between px-6 shrink-0 relative z-50"
                style="background:rgba(8,12,20,0.8); border-bottom:1px solid rgba(255,255,255,0.05); backdrop-filter:blur(10px);">

            <div class="flex items-center gap-4">
                <!-- Mobile menu toggle -->
                <button @click="sidebarOpen = true"
                        class="md:hidden text-slate-500 hover:text-cyan-400 transition-colors"
                        style="padding:0.5rem;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <!-- Breadcrumb / title -->
                <div>
                    <h1 class="font-bold text-sm" style="color:#F1F5F9; letter-spacing:-0.01em;">@yield('title', 'Dashboard')</h1>
                    <p class="text-xs" style="color:#475569;">Sistem Informasi Distribusi LPG</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <!-- User menu -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open"
                            class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl transition-all cursor-pointer hover:bg-slate-800"
                            style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.06);">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold shrink-0"
                             style="background:linear-gradient(135deg,#10B981,#06B6D4); color:white;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-xs font-semibold leading-none" style="color:#CBD5E1;">{{ auth()->user()->name }}</p>
                        </div>
                        <svg class="w-3.5 h-3.5 shrink-0" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition
                         class="absolute right-0 mt-2 w-56 rounded-xl py-2 z-[60]"
                         style="background:#0E1623; border:1px solid rgba(255,255,255,0.1); box-shadow:0 20px 40px rgba(0,0,0,0.5); display:none;">
                        <div class="px-4 py-3 mb-2" style="border-bottom:1px solid rgba(255,255,255,0.05);">
                            <p class="text-sm font-semibold" style="color:#F1F5F9;">{{ auth()->user()->username }}</p>
                            <p class="text-xs mt-0.5" style="color:#10B981;">{{ auth()->user()->roles->first()->name ?? 'User' }}</p>
                        </div>
                        <a href="/" class="flex items-center gap-3 px-4 py-2.5 text-sm transition-colors hover:bg-slate-800" style="color:#CBD5E1;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Beranda Publik
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block w-full mt-1">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm transition-colors hover:bg-red-900/20 cursor-pointer" style="color:#F43F5E;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6 bg-grid-pattern animate-slide-in">
            @if (session('success'))
                <div class="alert-success mb-5">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert-error mb-5">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
