<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PimpinanDaerahController extends Controller
{
    public function index()
    {
        // Dummy Data Statistik
        $statusKecamatan = [
            'Waspada' => 2,
            'Aman' => 15,
            'Krisis' => 1
        ];

        $totalPenyaluran = '120.500'; // Tabung
        $totalLpgMasuk = '125.000'; // Tabung
        $rekomendasiKuota = '130.000'; // Tabung
        $efektivitasAgen = '92%';
        
        $grafikKeluhan = [
            'Jan' => 15, 'Feb' => 20, 'Mar' => 10, 'Apr' => 5, 'Mei' => 25, 'Jun' => 8
        ];

        $rangkingMasalah = [
            ['kecamatan' => 'Kec. Sukamaju', 'kasus' => 12],
            ['kecamatan' => 'Kec. Harapan', 'kasus' => 8],
            ['kecamatan' => 'Kec. Damai', 'kasus' => 5],
        ];

        $grafikKonsumsi = [
            'Jan' => 110000, 'Feb' => 115000, 'Mar' => 120000, 'Apr' => 118000, 'Mei' => 125000, 'Jun' => 120500
        ];

        return view('dashboard.pimpinan_daerah', compact(
            'statusKecamatan', 'totalPenyaluran', 'totalLpgMasuk', 
            'rekomendasiKuota', 'efektivitasAgen', 'grafikKeluhan', 
            'rangkingMasalah', 'grafikKonsumsi'
        ));
    }
}
