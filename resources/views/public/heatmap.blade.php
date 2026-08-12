<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heatmap Kelangkaan - GASKEUN</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #020617; color: #F8FAFC; }
        .glass-header { background: rgba(15,23,42,0.6); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col relative">

    <div class="glass-header sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium mb-1.5 transition-colors" style="color:#64748B;">
                    <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hover:text-white transition-colors">Kembali ke Beranda</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight">Heatmap <span style="color:#06B6D4;">Kelangkaan LPG</span></h1>
            </div>
            <div>
                <a href="{{ route('public.keluhan.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full text-sm font-bold transition-all transform hover:scale-105 shadow-[0_0_15px_rgba(244,63,94,0.3)]" style="background:#F43F5E; color:#fff;">
                    Laporkan Kelangkaan
                </a>
            </div>
        </div>
    </div>

    <div class="flex-grow max-w-7xl mx-auto w-full p-4 md:p-6 flex flex-col">
        <div class="flex-grow rounded-2xl relative flex items-center justify-center min-h-[60vh]" style="background:rgba(255,255,255,0.02); border:1px dashed rgba(255,255,255,0.1);">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 mb-4" style="color:#475569;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" /></svg>
                <h2 class="text-xl font-bold mb-2" style="color:#CBD5E1;">Modul Heatmap Belum Aktif</h2>
                <p class="text-sm" style="color:#64748B;">Heatmap GIS Publik untuk data kelangkaan akan ditampilkan di sini.</p>
            </div>
        </div>
    </div>
    
</body>
</html>
