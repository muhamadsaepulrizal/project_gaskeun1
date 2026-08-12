<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Pangkalan LPG - GASKEUN</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #020617; color: #F8FAFC; }
        .glass-header { background: rgba(15,23,42,0.6); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); }
        #map {
            height: calc(100vh - 120px);
            width: 100%;
            border-radius: 1rem;
            z-index: 10;
        }
        
        /* Dark theme map popup overrides */
        .leaflet-popup-content-wrapper, .leaflet-popup-tip {
            background: rgba(15,23,42,0.95) !important;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
            color: #F8FAFC !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important;
        }
        .leaflet-popup-close-button {
            color: #94A3B8 !important;
        }
        .leaflet-container a.leaflet-popup-close-button:hover {
            color: #F8FAFC !important;
        }
    </style>
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
                <h1 class="text-2xl font-bold tracking-tight">Peta <span style="color:#10B981;">Pangkalan LPG</span></h1>
            </div>
            <div>
                <a href="{{ route('public.keluhan.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full text-sm font-bold transition-all transform hover:scale-105 shadow-[0_0_15px_rgba(244,63,94,0.3)]" style="background:#F43F5E; color:#fff;">
                    Laporkan Kelangkaan
                </a>
            </div>
        </div>
    </div>

    <div class="flex-grow max-w-7xl mx-auto w-full p-4 md:p-6">
        <div class="p-2 rounded-2xl relative" style="background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.05); box-shadow:0 0 40px rgba(0,0,0,0.3);">
            <!-- Map Container -->
            <div id="map"></div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize map
            const map = L.map('map').setView([-6.200000, 106.816666], 13);
            
            // Dark Mode Map Tiles (CartoDB Dark Matter)
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
            }).addTo(map);

            // Data from Controller
            const pangkalanData = {!! json_encode($pangkalanList) !!};

            // Custom Leaflet icon (Neon Emerald)
            const customIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            pangkalanData.forEach(function(pangkalan) {
                // Status styles
                let badgeClass = "badge-active";
                let statusColor = "#10B981";
                let statusBg = "rgba(16,185,129,0.1)";
                
                if(pangkalan.status === 'Krisis') {
                    badgeClass = "badge-danger";
                    statusColor = "#F43F5E";
                    statusBg = "rgba(244,63,94,0.1)";
                }

                // Popup Content with Dark Theme
                const contentString = `
                    <div style="font-family:'Space Grotesk',sans-serif; min-width:220px; padding:4px;">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:8px;">
                            <h3 style="font-weight:700; font-size:1.1rem; color:#F8FAFC; margin:0; line-height:1.2;">${pangkalan.nama}</h3>
                            <span style="font-size:0.7rem; font-weight:700; padding:2px 8px; border-radius:999px; background:${statusBg}; border:1px solid ${statusColor}40; color:${statusColor}; ml-2">${pangkalan.status}</span>
                        </div>
                        <p style="font-size:0.8rem; color:#94A3B8; margin:0 0 12px 0;">${pangkalan.alamat}</p>
                        
                        <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.05); border-radius:8px; padding:10px; margin-bottom:12px;">
                            <p style="font-size:0.7rem; color:#CBD5E1; margin:0 0 4px 0; text-transform:uppercase; letter-spacing:0.05em;">Stok Saat Ini</p>
                            <p style="font-weight:800; font-size:1.5rem; margin:0; color:#F8FAFC; line-height:1;">${pangkalan.stok} <span style="font-size:0.8rem; font-weight:400; color:#94A3B8;">Tabung</span></p>
                        </div>
                        
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${pangkalan.latitude},${pangkalan.longitude}" target="_blank" style="display:block; text-align:center; background:#3B82F6; color:#fff; font-size:0.85rem; font-weight:600; padding:8px; border-radius:6px; text-decoration:none; transition:0.2s;">
                            Navigasi ke Lokasi
                        </a>
                    </div>
                `;

                // Add marker
                L.marker([parseFloat(pangkalan.latitude), parseFloat(pangkalan.longitude)], {icon: customIcon})
                    .addTo(map)
                    .bindPopup(contentString);
            });
        });
    </script>
</body>
</html>
