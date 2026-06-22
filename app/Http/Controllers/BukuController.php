<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategoris')->latest()->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku'    => 'required|string|unique:bukus,kode_buku',
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok'         => 'required|integer|min:0',
            'isbn'         => 'nullable|string|max:20',
            'sinopsis'     => 'nullable|string',
            'cover'        => 'nullable|image|max:2048',
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategoris,id',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku = Buku::create($validated);

        if ($request->filled('kategori_ids')) {
            $buku->kategoris()->sync($request->kategori_ids);
        }

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load('kategoris', 'peminjamans.anggota');
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $selectedKategoris = $buku->kategoris->pluck('id')->toArray();
        return view('buku.edit', compact('buku', 'kategoris', 'selectedKategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kode_buku'    => 'required|string|unique:bukus,kode_buku,' . $buku->id,
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok'         => 'required|integer|min:0',
            'isbn'         => 'nullable|string|max:20',
            'sinopsis'     => 'nullable|string',
            'cover'        => 'nullable|image|max:2048',
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategoris,id',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($validated);
        $buku->kategoris()->sync($request->kategori_ids ?? []);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->kategoris()->detach();
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
