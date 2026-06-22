<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::latest()->paginate(10);
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_anggota' => 'required|string|unique:anggotas,no_anggota',
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email|unique:anggotas,email',
            'no_hp'      => 'nullable|string|max:20',
            'alamat'     => 'nullable|string',
            'status'     => 'required|in:aktif,nonaktif',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        $anggota->load('peminjamans.buku', 'dendas');
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'no_anggota' => 'required|string|unique:anggotas,no_anggota,' . $anggota->id,
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email|unique:anggotas,email,' . $anggota->id,
            'no_hp'      => 'nullable|string|max:20',
            'alamat'     => 'nullable|string',
            'status'     => 'required|in:aktif,nonaktif',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
