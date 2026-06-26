<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategoris');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('penulis', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_buku', 'like', '%' . $request->search . '%');
            });
        }

        $bukus = $query->latest()->paginate(10)->withQueryString();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        // Generate kode otomatis: BK-XXXX (cari nomor terakhir + 1)
        $last = Buku::orderByDesc('id')->first();

        if ($last) {
            // Ambil angka dari kode terakhir, misal "BK-0023" → 23
            $lastNum = (int) preg_replace('/[^0-9]/', '', $last->kode_buku);
            $nextNum = $lastNum + 1;
        } else {
            $nextNum = 1;
        }

        $kodeBuku = 'BK-' . str_pad($nextNum, 4, '0', STR_PAD_LEFT);

        return view('buku.create', compact('kategoris', 'kodeBuku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:bukus|max:50',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'isbn' => 'nullable|string|max:20',
            'sinopsis' => 'nullable|string',
            'kategori_ids' => 'nullable|array',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['cover', 'kategori_ids', '_token']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku = Buku::create($data);

        if ($request->filled('kategori_ids')) {
            $buku->kategoris()->sync($request->kategori_ids);
        }

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load('kategoris', 'peminjamans.anggota');
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();
        $selectedKategori = $buku->kategoris->pluck('id')->toArray();
        return view('buku.edit', compact('buku', 'kategoris', 'selectedKategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|max:50|unique:bukus,kode_buku,' . $buku->id,
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'isbn' => 'nullable|string|max:20',
            'sinopsis' => 'nullable|string',
            'kategori_ids' => 'nullable|array',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['cover', 'kategori_ids', '_token', '_method']);

        if ($request->hasFile('cover')) {
            if ($buku->cover)
                Storage::disk('public')->delete($buku->cover);
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($data);
        $buku->kategoris()->sync($request->kategori_ids ?? []);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->cover)
            Storage::disk('public')->delete($buku->cover);
        $buku->delete();
        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}