<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASKEUN - Sistem Distribusi LPG Tepat Sasaran</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #020617; color: #F8FAFC; }
        .glass-nav { background: rgba(2, 6, 23, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); }
        .hero-glow { position: absolute; width: 600px; height: 600px; background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, rgba(0,0,0,0) 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1; pointer-events: none; }
        .feature-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; }
        .feature-card:hover { border-color: rgba(16,185,129,0.3); background: rgba(16,185,129,0.02); transform: translateY(-5px); }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="glass-nav fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-extrabold text-2xl tracking-tighter" style="color:#10B981;">GASKEUN<span style="color:#F8FAFC;">.</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('public.peta') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors hidden md:inline">Peta LPG</a>
                    <a href="{{ route('public.heatmap') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors hidden md:inline">Heatmap</a>
                    <a href="{{ route('public.keluhan.create') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors hidden md:inline">Kirim Keluhan</a>
                    <div class="h-6 w-px hidden md:block" style="background:rgba(255,255,255,0.1);"></div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                            @csrf
                            <button type="submit" class="px-6 py-2.5 rounded-full text-sm font-bold transition-all transform hover:-translate-y-1 cursor-pointer shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)]" style="background:#10B981; color:#020617; border:none; outline:none;">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors hidden sm:inline">Masuk</a>
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full text-sm font-bold transition-all transform hover:-translate-y-1 shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)]" style="background:#10B981; color:#020617;">Mulai</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative flex-grow pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden flex items-center min-h-[80vh]">
        <div class="hero-glow"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-emerald-400 text-xs font-mono font-medium mb-8 tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Berbasis Data
                </div>
                <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl lg:text-7xl mb-6">
                    <span class="block text-slate-100">Distribusi LPG</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Tepat Sasaran</span>
                </h1>
                <p class="mt-6 text-base text-slate-400 sm:text-lg md:text-xl lg:mx-0 max-w-2xl mx-auto leading-relaxed">
                    GASKEUN hadir untuk memastikan penyaluran LPG bersubsidi lebih transparan, terdata dengan baik, dan akurat dari Agen hingga ke tangan masyarakat.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row sm:justify-center gap-4">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3.5 text-base font-bold rounded-full transition-all transform hover:scale-105 md:py-4 md:text-lg md:px-10 shadow-[0_0_20px_rgba(16,185,129,0.3)]" style="background:#10B981; color:#020617;">
                        Masuk ke Sistem
                    </a>
                    <a href="{{ route('public.keluhan.create') }}" class="w-full flex items-center justify-center px-8 py-3.5 text-base font-bold rounded-full transition-all transform hover:scale-105 md:py-4 md:text-lg md:px-10" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#F8FAFC;">
                        Laporkan Keluhan
                    </a>
                </div>
                <div class="mt-8 flex flex-col sm:flex-row sm:justify-center gap-6 text-sm">
                    <a href="{{ route('public.peta') }}" class="flex items-center justify-center text-emerald-400 hover:text-emerald-300 transition-colors font-medium">
                        <svg class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                        Lihat Peta LPG
                    </a>
                    <a href="{{ route('public.heatmap') }}" class="flex items-center justify-center text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
                        <svg class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" /></svg>
                        Lihat Heatmap
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="py-20 relative border-t border-slate-800" style="background:#020617;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16">
                <h2 class="text-sm font-mono tracking-widest uppercase mb-3" style="color:#10B981;">// Keunggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Ekosistem Terintegrasi
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="feature-card p-8 rounded-2xl">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-xl mb-6 shadow-[0_0_15px_rgba(16,185,129,0.2)]" style="background:rgba(16,185,129,0.1); color:#10B981; border:1px solid rgba(16,185,129,0.2);">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-3">Transparan</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Seluruh alur pengiriman dari Agen ke Pangkalan tercatat secara real-time dan dapat dipantau.</p>
                </div>
                <!-- Card 2 -->
                <div class="feature-card p-8 rounded-2xl">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-xl mb-6 shadow-[0_0_15px_rgba(6,182,212,0.2)]" style="background:rgba(6,182,212,0.1); color:#06B6D4; border:1px solid rgba(6,182,212,0.2);">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-3">Tepat Sasaran</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Integrasi data kependudukan dan UMKM memastikan penerima subsidi adalah yang benar-benar berhak.</p>
                </div>
                <!-- Card 3 -->
                <div class="feature-card p-8 rounded-2xl">
                    <div class="w-14 h-14 inline-flex items-center justify-center rounded-xl mb-6 shadow-[0_0_15px_rgba(139,92,246,0.2)]" style="background:rgba(139,92,246,0.1); color:#8B5CF6; border:1px solid rgba(139,92,246,0.2);">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-3">Analitik Eksekutif</h3>
                    <p class="text-slate-400 leading-relaxed text-sm">Laporan dan pemantauan stok yang komprehensif bagi Pimpinan Daerah dan Disperindag.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-10 border-t border-slate-800" style="background:#020617;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <span class="font-extrabold text-xl tracking-tighter mb-4" style="color:#10B981;">GASKEUN<span style="color:#F8FAFC;">.</span></span>
            <p class="text-slate-500 text-xs tracking-wide uppercase">&copy; {{ date('Y') }} Sistem Informasi Distribusi LPG Tepat Sasaran.</p>
        </div>
    </footer>
</body>
</html>
