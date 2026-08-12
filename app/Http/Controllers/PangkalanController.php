<?php

namespace App\Http\Controllers;

use App\Models\KoreksiPengiriman;
use App\Models\Penduduk;
use App\Models\StokPangkalan;
use App\Models\TransaksiPengiriman;
use App\Models\TransaksiPenyaluran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PangkalanController extends Controller
{
    public function dashboard()
    {
        // Dummy metrics for Pangkalan Dashboard
        $stokTersedia = 120;
        $totalPenerimaan = 500;
        $totalPenyaluran = 380;
        return view('pangkalan.dashboard', compact('stokTersedia', 'totalPenerimaan', 'totalPenyaluran'));
    }

    // ============================================================
    // TERIMA PENGIRIMAN LPG
    // ============================================================
    public function terimaPengiriman()
    {
        $pengiriman = TransaksiPengiriman::with(['agen', 'koreksi'])
            ->where('pangkalan_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pangkalan.pengiriman.index', compact('pengiriman'));
    }

    // Konfirmasi penerimaan -> otomatis tambah stok
    public function konfirmasiPenerimaan(TransaksiPengiriman $pengiriman)
    {
        if ($pengiriman->pangkalan_id !== Auth::id()) {
            abort(403);
        }

        DB::transaction(function () use ($pengiriman) {
            $pengiriman->update(['status' => 'Diterima']);

            // Tambah stok pangkalan
            $stok = StokPangkalan::firstOrCreate(
                ['user_id' => Auth::id()],
                ['jumlah_tabung' => 0]
            );
            $stok->increment('jumlah_tabung', $pengiriman->jumlah_tabung);
        });

        return redirect()->route('pangkalan.pengiriman.index')
            ->with('success', "Pengiriman dikonfirmasi. Stok bertambah {$pengiriman->jumlah_tabung} tabung.");
    }

    // Ajukan koreksi jika data salah
    public function ajukanKoreksi(Request $request, TransaksiPengiriman $pengiriman)
    {
        if ($pengiriman->pangkalan_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'jumlah_seharusnya'   => 'required|integer|min:0',
            'keterangan_koreksi'  => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($request, $pengiriman) {
            $pengiriman->update(['status' => 'Dikoreksi']);

            KoreksiPengiriman::create([
                'transaksi_pengiriman_id' => $pengiriman->id,
                'jumlah_seharusnya'       => $request->jumlah_seharusnya,
                'keterangan_koreksi'      => $request->keterangan_koreksi,
                'status_koreksi'          => 'Menunggu',
            ]);
        });

        return redirect()->route('pangkalan.pengiriman.index')
            ->with('success', 'Koreksi berhasil diajukan.');
    }

    // ============================================================
    // SALURKAN LPG
    // ============================================================
    public function penyaluranCreate()
    {
        $stok = StokPangkalan::where('user_id', Auth::id())->first();
        $jumlahStok = $stok ? $stok->jumlah_tabung : 0;
        $konsumens = Penduduk::all();

        return view('pangkalan.penyaluran.create', compact('jumlahStok', 'konsumens'));
    }

    public function penyaluranStore(Request $request)
    {
        $request->validate([
            'kategori_konsumen' => 'required|in:Rumah Tangga,UMKM,Nelayan,Petani',
            'penduduk_id'       => 'required|exists:penduduks,id',
            'jumlah_tabung'     => 'required|integer|min:1',
            'tanggal_penyaluran'=> 'required|date',
        ]);

        $stok = StokPangkalan::where('user_id', Auth::id())->first();
        if (!$stok || $stok->jumlah_tabung < $request->jumlah_tabung) {
            return back()->with('error', 'Stok LPG tidak mencukupi! Sisa stok: ' . ($stok->jumlah_tabung ?? 0) . ' tabung.');
        }

        DB::transaction(function () use ($request, $stok) {
            TransaksiPenyaluran::create([
                'pangkalan_id'      => Auth::id(),
                'kategori_konsumen' => $request->kategori_konsumen,
                'penduduk_id'       => $request->penduduk_id,
                'jumlah_tabung'     => $request->jumlah_tabung,
                'tanggal_penyaluran'=> $request->tanggal_penyaluran,
            ]);

            // Kurangi stok otomatis
            $stok->decrement('jumlah_tabung', $request->jumlah_tabung);
        });

        return redirect()->route('pangkalan.stok')
            ->with('success', "Penyaluran {$request->jumlah_tabung} tabung berhasil. Stok dikurangi otomatis.");
    }

    // ============================================================
    // LIHAT SISA STOK LPG
    // ============================================================
    public function sisaStok()
    {
        $stok = StokPangkalan::where('user_id', Auth::id())->first();
        $jumlahStok = $stok ? $stok->jumlah_tabung : 0;

        $riwayatPenyaluran = TransaksiPenyaluran::with('penduduk')
            ->where('pangkalan_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pangkalan.stok.index', compact('jumlahStok', 'riwayatPenyaluran'));
    }
}
