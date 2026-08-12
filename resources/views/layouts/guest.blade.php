<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASKEUN — @yield('title', 'Auth')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @keyframes orbit {
            from { transform: rotate(0deg) translateX(120px) rotate(0deg); }
            to   { transform: rotate(360deg) translateX(120px) rotate(-360deg); }
        }
        @keyframes orbit2 {
            from { transform: rotate(180deg) translateX(180px) rotate(-180deg); }
            to   { transform: rotate(540deg) translateX(180px) rotate(-540deg); }
        }
        .orbit-dot-1 { animation: orbit 8s linear infinite; }
        .orbit-dot-2 { animation: orbit2 13s linear infinite; }
        .grid-bg {
            background-image: linear-gradient(rgba(6,182,212,0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(6,182,212,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body style="background-color:#080C14; color:#F1F5F9; font-family:'Space Grotesk',sans-serif;" class="antialiased min-h-screen flex">

    <!-- ═══ LEFT: Branding Panel ═══ -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center" style="background:#060A10;">
        <!-- Grid pattern -->
        <div class="absolute inset-0 grid-bg opacity-60"></div>

        <!-- Glow orbs -->
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full" style="background:radial-gradient(circle, rgba(6,182,212,0.15) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 rounded-full" style="background:radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 70%);"></div>

        <!-- Orbit rings (decorative) -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 rounded-full pointer-events-none" style="border:1px solid rgba(6,182,212,0.12);">
            <div class="orbit-dot-1 absolute top-1/2 left-1/2 w-2.5 h-2.5 rounded-full -translate-x-1/2 -translate-y-1/2" style="background:#06B6D4; box-shadow:0 0 10px rgba(6,182,212,0.8);"></div>
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full pointer-events-none" style="border:1px dashed rgba(16,185,129,0.08);">
            <div class="orbit-dot-2 absolute top-1/2 left-1/2 w-1.5 h-1.5 rounded-full -translate-x-1/2 -translate-y-1/2" style="background:#10B981; box-shadow:0 0 8px rgba(16,185,129,0.8);"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-14 max-w-lg">
            <!-- Logo icon -->
            <div class="flex justify-center mb-8">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center relative" style="background:linear-gradient(135deg,rgba(16,185,129,0.15),rgba(6,182,212,0.15)); border:1px solid rgba(6,182,212,0.25); box-shadow:0 0 40px rgba(6,182,212,0.2);">
                    <svg class="w-10 h-10" style="color:#06B6D4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>

            <h1 style="font-size:3rem; font-weight:800; letter-spacing:-0.04em; line-height:1.1; color:#F1F5F9;">
                GAS<span style="background:linear-gradient(135deg,#10B981,#06B6D4); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">KEUN.</span>
            </h1>
            <p class="mt-4" style="color:#475569; font-size:0.875rem; line-height:1.7; font-weight:400;">
                Sistem Informasi Distribusi LPG Bersubsidi. Pantau penyaluran, kelangkaan, dan keluhan masyarakat secara real-time.
            </p>

            <!-- Feature pills -->
            <div class="flex flex-wrap justify-center gap-2 mt-8">
                <span class="text-xs px-3 py-1.5 rounded-full" style="background:rgba(6,182,212,0.08); color:#06B6D4; border:1px solid rgba(6,182,212,0.15);">📍 Peta Distribusi</span>
                <span class="text-xs px-3 py-1.5 rounded-full" style="background:rgba(16,185,129,0.08); color:#10B981; border:1px solid rgba(16,185,129,0.15);">📊 Heatmap</span>
                <span class="text-xs px-3 py-1.5 rounded-full" style="background:rgba(245,158,11,0.08); color:#F59E0B; border:1px solid rgba(245,158,11,0.15);">⚡ Real-time</span>
            </div>
        </div>

        <!-- Bottom version tag -->
        <div class="absolute bottom-6 left-0 right-0 text-center">
            <span style="font-size:0.6875rem; color:#1E293B; letter-spacing:0.1em;">GASKEUN v2.0 · POWERED BY LARAVEL</span>
        </div>
    </div>

    <!-- ═══ RIGHT: Form Panel ═══ -->
    <div class="w-full lg:w-1/2 flex flex-col relative" style="background:#080C14;">
        <!-- Subtle top border glow -->
        <div class="absolute top-0 left-0 right-0 h-px" style="background:linear-gradient(90deg, transparent, rgba(6,182,212,0.3), transparent);"></div>

        <!-- Back button -->
        <nav class="absolute top-0 right-0 p-6 z-10">
            <a href="/" class="flex items-center gap-2 text-xs font-medium transition-all px-4 py-2 rounded-xl"
               style="color:#475569; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.05);"
               onmouseover="this.style.color='#06B6D4'; this.style.borderColor='rgba(6,182,212,0.2)'"
               onmouseout="this.style.color='#475569'; this.style.borderColor='rgba(255,255,255,0.05)'">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Beranda
            </a>
        </nav>

        <!-- Mobile logo -->
        <div class="lg:hidden flex justify-center pt-16 pb-4">
            <span style="font-size:1.5rem; font-weight:800; letter-spacing:-0.03em; color:#F1F5F9;">GAS<span style="color:#06B6D4;">KEUN.</span></span>
        </div>

        <!-- Form Area -->
        <main class="flex-grow flex items-center justify-center px-8 sm:px-12 lg:px-16 py-12">
            <div class="w-full max-w-md">
                @if (session('success'))
                    <div class="alert-success mb-6">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert-error mb-6">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
