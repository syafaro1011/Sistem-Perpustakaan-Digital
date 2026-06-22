<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Denda;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik Utama ──────────────────────────────────────
        $totalBuku = Buku::sum('stok');
        $totalJudulBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalKategori = Kategori::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $peminjamanSelesai = Peminjaman::where('status', 'dikembalikan')->count();
        $totalTerlambat = Peminjaman::where('status', 'terlambat')->count();
        $dendaBelumBayar = Denda::where('status_bayar', 'belum_bayar')->sum('jumlah_denda');
        $dendaSudahBayar = Denda::where('status_bayar', 'sudah_bayar')->sum('jumlah_denda');

        // ── Peminjaman per bulan (12 bulan terakhir) ─────────────
        $peminjamanPerBulan = Peminjaman::select(
            DB::raw('MONTH(tanggal_pinjam) as bulan'),
            DB::raw('YEAR(tanggal_pinjam) as tahun'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('tanggal_pinjam', now()->year)
            ->groupBy('tahun', 'bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $labelBulan = [];
        $dataBulan = [];
        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];
        for ($i = 1; $i <= 12; $i++) {
            $labelBulan[] = $namaBulan[$i];
            $dataBulan[] = $peminjamanPerBulan->get($i)->total ?? 0;
        }

        // ── Top 5 Buku paling sering dipinjam ────────────────────
        $topBuku = Buku::withCount('peminjamans')
            ->orderByDesc('peminjamans_count')
            ->limit(5)
            ->get();

        // ── Distribusi Kategori ───────────────────────────────────
        $kategoriData = Kategori::withCount('bukus')
            ->orderByDesc('bukus_count')
            ->get();

        // ── Peminjaman terlambat (masih aktif) ────────────────────
        $terlambatList = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->orderBy('tanggal_kembali')
            ->limit(5)
            ->get();

        // ── Peminjaman terbaru ────────────────────────────────────
        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalJudulBuku',
            'totalAnggota',
            'totalKategori',
            'peminjamanAktif',
            'peminjamanSelesai',
            'totalTerlambat',
            'dendaBelumBayar',
            'dendaSudahBayar',
            'labelBulan',
            'dataBulan',
            'topBuku',
            'kategoriData',
            'terlambatList',
            'peminjamanTerbaru'
        ));
    }
}