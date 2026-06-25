<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('no_anggota', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('aktif')) {
            $query->where('status', "aktif");
        }

        if ($request->filled('nonaktif')) {
            $query->where('status', "nonaktif");
        }

        $anggotas = $query->latest()->paginate(10)->withQueryString();
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_anggota' => 'required|unique:anggotas|max:20',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:anggotas',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'no_anggota' => 'required|max:20|unique:anggotas,no_anggota,' . $anggota->id,
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:anggotas,email,' . $anggota->id,
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}