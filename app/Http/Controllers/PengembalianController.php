<?php
namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Denda;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // Denda per hari (Rp)
    const DENDA_PER_HARI = 2000;

    public function index(Request $request)
    {
        $query = Pengembalian::with(['peminjaman.anggota', 'peminjaman.buku', 'denda']);

        $pengembalians = $query->latest()->paginate(10)->withQueryString();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create(Request $request)
    {
        $peminjaman = null;

        if ($request->filled('peminjaman_id')) {
            $peminjaman = Peminjaman::with(['anggota', 'buku'])
                ->findOrFail($request->peminjaman_id);
        }

        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'dipinjam')
            ->get();

        return view('pengembalian.create', compact('peminjamans', 'peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali_aktual' => 'required|date',
            'kondisi_buku' => 'required|in:baik,rusak,hilang',
            'catatan' => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Hitung keterlambatan
        $hariTerlambat = max(
            0,
            now()->parse($request->tanggal_kembali_aktual)
                ->diffInDays($peminjaman->tanggal_kembali, false) * -1
        );

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali_aktual' => $request->tanggal_kembali_aktual,
            'hari_terlambat' => $hariTerlambat,
            'kondisi_buku' => $request->kondisi_buku,
            'catatan' => $request->catatan,
        ]);

        // Update status peminjaman
        $peminjaman->update([
            'status' => $hariTerlambat > 0 ? 'terlambat' : 'dikembalikan'
        ]);

        // Kembalikan stok buku (jika buku tidak hilang)
        if ($request->kondisi_buku !== 'hilang') {
            $peminjaman->buku->increment('stok');
        }

        // Buat denda otomatis jika terlambat atau buku rusak/hilang
        $jumlahDenda = $hariTerlambat * self::DENDA_PER_HARI;
        if ($request->kondisi_buku === 'rusak')
            $jumlahDenda += 50000;
        if ($request->kondisi_buku === 'hilang')
            $jumlahDenda += 200000;

        if ($jumlahDenda > 0) {
            Denda::create([
                'pengembalian_id' => $pengembalian->id,
                'anggota_id' => $peminjaman->anggota_id,
                'hari_terlambat' => $hariTerlambat,
                'jumlah_denda' => $jumlahDenda,
                'status_bayar' => 'belum_bayar',
            ]);
        }

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil dicatat.' .
                ($jumlahDenda > 0 ? ' Denda: Rp ' . number_format($jumlahDenda) : ''));
    }
}