<?php
namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DendaController extends Controller
{
    public function index()
    {
        $dendas = Denda::with(['anggota', 'pengembalian.peminjaman.buku'])
            ->latest()
            ->paginate(10);
        return view('denda.index', compact('dendas'));
    }

    public function create()
    {
        return view('denda.create');
    }

    public function store(Request $request)
    {
        // Denda dibuat otomatis via PengembalianController, tapi bisa dibuat manual
        $validated = $request->validate([
            'pengembalian_id' => 'required|exists:pengembalians,id',
            'anggota_id'      => 'required|exists:anggotas,id',
            'hari_terlambat'  => 'required|integer|min:1',
            'jumlah_denda'    => 'required|numeric|min:0',
            'status_bayar'    => 'required|in:belum,lunas',
        ]);

        Denda::create($validated);

        return redirect()->route('denda.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function show(Denda $denda)
    {
        $denda->load(['anggota', 'pengembalian.peminjaman.buku']);
        return view('denda.show', compact('denda'));
    }

    public function edit(Denda $denda)
    {
        return view('denda.edit', compact('denda'));
    }

    public function update(Request $request, Denda $denda)
    {
        $validated = $request->validate([
            'status_bayar'  => 'required|in:belum,lunas',
            'tanggal_bayar' => 'nullable|date',
        ]);

        if ($validated['status_bayar'] === 'lunas' && empty($validated['tanggal_bayar'])) {
            $validated['tanggal_bayar'] = Carbon::today();
        }

        $denda->update($validated);

        return redirect()->route('denda.index')->with('success', 'Status denda berhasil diperbarui.');
    }

    public function destroy(Denda $denda)
    {
        $denda->delete();
        return redirect()->route('denda.index')->with('success', 'Data denda berhasil dihapus.');
    }
}
