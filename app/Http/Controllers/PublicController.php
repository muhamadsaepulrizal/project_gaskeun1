<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function peta()
    {
        // Dummy Data Pangkalan untuk Peta
        $pangkalanList = [
            [
                'id' => 1,
                'nama' => 'Pangkalan LPG Berkah',
                'alamat' => 'Jl. Merdeka No. 10, Kec. Sukamaju',
                'stok' => 50,
                'status' => 'Aman',
                'latitude' => '-6.200000',
                'longitude' => '106.816666'
            ],
            [
                'id' => 2,
                'nama' => 'Pangkalan Maju Jaya',
                'alamat' => 'Jl. Sudirman No. 45, Kec. Harapan',
                'stok' => 10,
                'status' => 'Krisis',
                'latitude' => '-6.210000',
                'longitude' => '106.826666'
            ],
            [
                'id' => 3,
                'nama' => 'Pangkalan Sumber Rejeki',
                'alamat' => 'Jl. Pahlawan No. 8, Kec. Damai',
                'stok' => 100,
                'status' => 'Aman',
                'latitude' => '-6.190000',
                'longitude' => '106.836666'
            ]
        ];

        return view('public.peta', compact('pangkalanList'));
    }

    public function heatmap()
    {
        // Placeholder view for heatmap
        return view('public.heatmap');
    }
}
