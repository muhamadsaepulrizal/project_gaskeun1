<?php

namespace App\Http\Controllers;

use App\Models\ProfilAgen;
use App\Models\TransaksiPengiriman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AgenController extends Controller
{
    public function dashboard()
    {
        // Dummy metrics for Agen Dashboard
        $totalPengiriman = 120;
        $totalPangkalan = 15;
        $stokTersedia = 5000;
        return view('agen.dashboard', compact('totalPengiriman', 'totalPangkalan', 'stokTersedia'));
    }

    // ============================================================
    // PROFIL AGEN
    // ============================================================
    public function profil()
    {
        $profil = ProfilAgen::firstOrCreate(
            ['user_id' => Auth::id()],
            ['nama_agen' => Auth::user()->name ?? Auth::user()->username]
        );
        return view('agen.profil', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama_agen'      => 'required|string|max:255',
            'no_registrasi'  => 'nullable|string|max:100',
            'alamat'         => 'nullable|string',
            'kontak'         => 'nullable|string|max:50',
        ]);

        ProfilAgen::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only('nama_agen', 'no_registrasi', 'alamat', 'kontak')
        );

        return redirect()->route('agen.profil')->with('success', 'Profil Agen berhasil diperbarui.');
    }

    // ============================================================
    // INPUT PENGIRIMAN LPG
    // ============================================================
    public function pengirimanCreate()
    {
        $pangkalans = User::role('Pangkalan LPG')->get();
        return view('agen.pengiriman.create', compact('pangkalans'));
    }

    public function pengirimanStore(Request $request)
    {
        $request->validate([
            'pangkalan_id'      => 'required|exists:users,id',
            'jumlah_tabung'     => 'required|integer|min:1',
            'tanggal_pengiriman'=> 'required|date',
            'foto_bukti'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('pangkalan_id', 'jumlah_tabung', 'tanggal_pengiriman');
        $data['agen_id'] = Auth::id();
        $data['status'] = 'Menunggu';

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('pengiriman/foto', 'public');
        }

        TransaksiPengiriman::create($data);

        return redirect()->route('agen.pengiriman.status')->with('success', 'Data pengiriman LPG berhasil disimpan.');
    }

    // ============================================================
    // IMPORT EXCEL PENGIRIMAN
    // ============================================================
    public function pengirimanImport(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            // Baca file Excel secara manual menggunakan PhpSpreadsheet (sudah di-include lewat maatwebsite/excel)
            $file = $request->file('file_excel');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $header = array_shift($rows); // Baris pertama = header
            $imported = 0;

            DB::transaction(function () use ($rows, &$imported) {
                foreach ($rows as $row) {
                    if (empty($row[0])) continue; // Skip baris kosong

                    TransaksiPengiriman::create([
                        'agen_id'            => Auth::id(),
                        'pangkalan_id'       => $row[0], // Kolom A = ID Pangkalan
                        'jumlah_tabung'      => $row[1], // Kolom B = Jumlah
                        'tanggal_pengiriman'  => $row[2] ?? now()->toDateString(), // Kolom C = Tanggal
                        'status'             => 'Menunggu',
                    ]);
                    $imported++;
                }
            });

            return redirect()->route('agen.pengiriman.status')
                ->with('success', "Berhasil mengimpor {$imported} data pengiriman dari file Excel.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor Excel: ' . $e->getMessage());
        }
    }

    // ============================================================
    // LIHAT STATUS PENGIRIMAN
    // ============================================================
    public function pengirimanStatus()
    {
        $pengiriman = TransaksiPengiriman::with(['pangkalan', 'koreksi'])
            ->where('agen_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('agen.pengiriman.status', compact('pengiriman'));
    }
}
