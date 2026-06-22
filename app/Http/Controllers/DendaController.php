<?php
namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Denda::with(['anggota', 'pengembalian.peminjaman.buku']);

        if ($request->filled('status')) {
            $query->where('status_bayar', $request->status);
        }

        $dendas = $query->latest()->paginate(10)->withQueryString();
        return view('denda.index', compact('dendas'));
    }

    // Proses pembayaran denda
    public function bayar(Denda $denda)
    {
        $denda->update([
            'status_bayar' => 'sudah_bayar',
            'tanggal_bayar' => now(),
        ]);

        return redirect()->route('denda.index')
            ->with('success', 'Denda berhasil dibayar.');
    }
}