<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku', 'user'])
            ->latest()
            ->paginate(10);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        $bukus    = Buku::where('stok', '>', 0)->orderBy('judul')->get();
        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'      => 'required|exists:anggotas,id',
            'buku_id'         => 'required|exists:bukus,id',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($validated['buku_id']);
        if ($buku->stok < 1) {
            return back()->withErrors(['buku_id' => 'Stok buku tidak tersedia.'])->withInput();
        }

        $validated['user_id'] = auth()->id();
        $validated['status']  = 'dipinjam';

        Peminjaman::create($validated);
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['anggota', 'buku', 'user', 'pengembalian.denda']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $anggotas = Anggota::where('status', 'aktif')->orderBy('nama')->get();
        $bukus    = Buku::orderBy('judul')->get();
        return view('peminjaman.edit', compact('peminjaman', 'anggotas', 'bukus'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'status'          => 'required|in:dipinjam,dikembalikan,terlambat',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Kembalikan stok jika masih berstatus dipinjam
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
