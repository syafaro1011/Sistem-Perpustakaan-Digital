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
        return Excel::download(new BukuExport, 'data-buku-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelAnggota()
    {
        return Excel::download(new AnggotaExport, 'data-anggota-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelPeminjaman()
    {
        return Excel::download(new PeminjamanExport, 'data-peminjaman-' . now()->format('Ymd') . '.xlsx');
    }

    public function excelDenda()
    {
        return Excel::download(new DendaExport, 'data-denda-' . now()->format('Ymd') . '.xlsx');
    }

    // ── PDF ───────────────────────────────────────────────────────
    public function pdfBuku()
    {
        $bukus = Buku::with('kategoris')->get();
        $pdf = Pdf::loadView('pdf.buku', compact('bukus'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-buku-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfAnggota()
    {
        $anggotas = Anggota::all();
        $pdf = Pdf::loadView('pdf.anggota', compact('anggotas'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-anggota-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfPeminjaman()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        $pdf = Pdf::loadView('pdf.peminjaman', compact('peminjamans'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-peminjaman-' . now()->format('Ymd') . '.pdf');
    }

    public function pdfDenda()
    {
        $dendas = Denda::with(['anggota', 'pengembalian.peminjaman.buku'])->latest()->get();
        $pdf = Pdf::loadView('pdf.denda', compact('dendas'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('data-denda-' . now()->format('Ymd') . '.pdf');
    }
}