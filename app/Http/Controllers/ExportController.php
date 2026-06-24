<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Denda;
use App\Exports\BukuExport;
use App\Exports\AnggotaExport;
use App\Exports\PeminjamanExport;
use App\Exports\DendaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    // ── Excel ─────────────────────────────────────────────────────
    public function excelBuku()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export Excel data buku');

        return Excel::download(new BukuExport, 'data-buku-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelAnggota()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export Excel data anggota');

        return Excel::download(new AnggotaExport, 'data-anggota-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelPeminjaman()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export Excel data peminjaman');

        return Excel::download(new PeminjamanExport, 'data-peminjaman-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelDenda()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export Excel data denda');

        return Excel::download(new DendaExport, 'data-denda-' . now()->format('Ymd') . '.xlsx');
    }

    // ── PDF ───────────────────────────────────────────────────────
    public function pdfBuku()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export PDF data buku');

        $bukus = Buku::with('kategoris')->get();
        $pdf = Pdf::loadView('pdf.buku', compact('bukus'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-buku-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfAnggota()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export PDF data anggota');

        $anggotas = Anggota::all();
        $pdf = Pdf::loadView('pdf.anggota', compact('anggotas'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-anggota-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfPeminjaman()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export PDF data peminjaman');

        $peminjamans = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        $pdf = Pdf::loadView('pdf.peminjaman', compact('peminjamans'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-peminjaman-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfDenda()
    {
        activity('export')
            ->causedBy(auth()->user())
            ->log('Export PDF data denda');

        $dendas = Denda::with(['anggota', 'pengembalian.peminjaman.buku'])->latest()->get();
        $pdf = Pdf::loadView('pdf.denda', compact('dendas'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-denda-' . now()->format('Ymd') . '.pdf');
    }
}