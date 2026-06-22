<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['anggota', 'buku', 'user']);

        if ($request->filled('search')) {
            $query->whereHas(
                'anggota',
                fn($q) =>
                $q->where('nama', 'like', '%' . $request->search . '%')
            )->orWhereHas(
                    'buku',
                    fn($q) =>
                    $q->where('judul', 'like', '%' . $request->search . '%')
                );
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->paginate(10)->withQueryString();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::where('status', 'aktif')->get();
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return back()->with('error', 'Stok buku tidak tersedia.');
        }

        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load([
            'anggota',
            'buku.kategoris',
            'user',
            'pengembalian.denda'
        ]);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function destroy(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman dihapus.');
    }
}