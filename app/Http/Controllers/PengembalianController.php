<?php
namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Denda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.anggota', 'peminjaman.buku', 'denda'])
            ->latest()
            ->paginate(10);
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'dipinjam')
            ->latest()
            ->get();
        return view('pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peminjaman_id'          => 'required|exists:peminjamans,id',
            'tanggal_kembali_aktual' => 'required|date',
            'kondisi_buku'           => 'required|in:baik,rusak_ringan,rusak_berat',
            'catatan'                => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($validated['peminjaman_id']);

        // Hitung keterlambatan
        $tanggalKembaliAktual = Carbon::parse($validated['tanggal_kembali_aktual']);
        $tanggalSeharusnya    = Carbon::parse($peminjaman->tanggal_kembali);
        $hariTerlambat        = max(0, $tanggalSeharusnya->diffInDays($tanggalKembaliAktual, false) * -1);
        // diffInDays returns negative if actual is after due date
        $hariTerlambat = $tanggalKembaliAktual->gt($tanggalSeharusnya)
            ? $tanggalSeharusnya->diffInDays($tanggalKembaliAktual)
            : 0;

        $validated['hari_terlambat'] = $hariTerlambat;

        $pengembalian = Pengembalian::create($validated);

        // Buat denda otomatis jika terlambat (Rp 1.000/hari)
        if ($hariTerlambat > 0) {
            Denda::create([
                'pengembalian_id' => $pengembalian->id,
                'anggota_id'      => $peminjaman->anggota_id,
                'hari_terlambat'  => $hariTerlambat,
                'jumlah_denda'    => $hariTerlambat * 1000,
                'status_bayar'    => 'belum',
            ]);
        }

        // Update stok dan status peminjaman
        $peminjaman->buku->increment('stok');
        $peminjaman->update(['status' => 'dikembalikan']);

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dicatat.');
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.anggota', 'peminjaman.buku', 'denda']);
        return view('pengembalian.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $validated = $request->validate([
            'kondisi_buku' => 'required|in:baik,rusak_ringan,rusak_berat',
            'catatan'      => 'nullable|string',
        ]);

        $pengembalian->update($validated);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
