<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Keluhan - GASKEUN</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #020617; color: #F8FAFC; }
        .card-glow { background: rgba(15,23,42,0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); box-shadow: 0 0 40px rgba(0,0,0,0.5); }
        .input-field { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.1); color: #F8FAFC; transition: all 0.2s ease; }
        .input-field:focus { border-color: #10B981; outline: none; box-shadow: 0 0 0 2px rgba(16,185,129,0.2); background: rgba(16,185,129,0.02); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-4 relative overflow-x-hidden">
    <!-- Ambient glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] rounded-full pointer-events-none" style="background:radial-gradient(ellipse at top, rgba(16,185,129,0.15) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="w-full max-w-lg card-glow rounded-2xl p-8 relative z-10">
        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium mb-6 transition-colors" style="color:#64748B;">
            <svg class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="hover:text-white transition-colors">Kembali ke Beranda</span>
        </a>
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Kirim <span style="color:#10B981;">Keluhan</span></h1>
            <p class="text-sm" style="color:#94A3B8;">Sampaikan laporan Anda terkait penyaluran gas LPG bersubsidi.</p>
        </div>

        @if(session('success'))
            <div class="px-4 py-3 rounded-lg mb-6 text-sm font-medium flex items-center" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); color:#10B981;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('public.keluhan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Isi Keluhan -->
            <div>
                <label for="isi_keluhan" class="block text-sm font-medium mb-1.5" style="color:#CBD5E1;">Deskripsi Keluhan <span style="color:#F43F5E;">*</span></label>
                <textarea name="isi_keluhan" id="isi_keluhan" rows="4" required class="w-full px-4 py-3 rounded-xl input-field text-sm" placeholder="Jelaskan detail kejadian..."></textarea>
                @error('isi_keluhan')<p class="text-xs mt-1.5" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>

            <!-- Lokasi GPS -->
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#CBD5E1;">Koordinat Lokasi <span style="color:#F43F5E;">*</span></label>
                <div class="flex gap-3 mb-2">
                    <input type="text" name="latitude" id="latitude" placeholder="Latitude" class="w-1/2 px-4 py-2.5 rounded-lg input-field text-sm font-mono" readonly>
                    <input type="text" name="longitude" id="longitude" placeholder="Longitude" class="w-1/2 px-4 py-2.5 rounded-lg input-field text-sm font-mono" readonly>
                </div>
                <button type="button" id="btn-location" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-lg text-sm font-bold transition-all" style="background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.3); color:#06B6D4;">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Deteksi Lokasi GPS
                </button>
                <p id="location-status" class="text-xs mt-2 hidden"></p>
                @error('latitude')<p class="text-xs mt-1.5" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>

            <!-- Upload Foto Bukti -->
            <div>
                <label class="block text-sm font-medium mb-1.5" style="color:#CBD5E1;">Foto Bukti (Opsional)</label>
                <div class="relative group">
                    <div class="absolute inset-0 rounded-xl transition-all duration-300 group-hover:bg-emerald-500/5 border border-dashed border-slate-600 group-hover:border-emerald-500/50"></div>
                    <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*" class="relative z-10 w-full opacity-0 py-8 cursor-pointer">
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <svg class="h-8 w-8 mb-2" style="color:#64748B;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <span class="text-sm font-medium" style="color:#94A3B8;">Klik atau drop foto di sini</span>
                        <span class="text-xs mt-1" style="color:#475569;">Maksimal 5MB (JPG/PNG)</span>
                    </div>
                </div>
                <!-- Preview area -->
                <div id="image-preview-container" class="mt-3 hidden">
                    <img id="image-preview" src="#" alt="Preview" class="max-h-48 rounded-lg object-contain" style="border:1px solid rgba(255,255,255,0.1);">
                </div>
                @error('foto_bukti')<p class="text-xs mt-1.5" style="color:#F43F5E;">{{ $message }}</p>@enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-6">
                <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl font-bold text-sm transition-all transform hover:scale-[1.02] shadow-[0_0_20px_rgba(16,185,129,0.2)]" style="background:#10B981; color:#020617;">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>

    <script>
        // GPS Location Handling
        document.getElementById('btn-location').addEventListener('click', function() {
            const statusText = document.getElementById('location-status');
            statusText.classList.remove('hidden');
            statusText.textContent = "Mengakses satelit GPS...";
            statusText.style.color = '#06B6D4';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;
                        statusText.textContent = "Lokasi terkalibrasi!";
                        statusText.style.color = '#10B981';
                    },
                    function(error) {
                        statusText.textContent = "Akses ditolak. Pastikan izin lokasi browser aktif.";
                        statusText.style.color = '#F43F5E';
                    },
                    { enableHighAccuracy: true }
                );
            } else {
                statusText.textContent = "Perangkat tidak mendukung GPS.";
                statusText.style.color = '#F43F5E';
            }
        });

        // Image Preview Handling
        document.getElementById('foto_bukti').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    document.getElementById('image-preview-container').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
