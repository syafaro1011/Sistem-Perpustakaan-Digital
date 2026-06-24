<?php
namespace App\Exports;

use App\Models\Denda;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DendaExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function collection()
    {
        return Denda::with(['anggota', 'pengembalian.peminjaman.buku'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Anggota',
            'Judul Buku',
            'Hari Terlambat',
            'Jumlah Denda',
            'Status',
            'Tanggal Bayar'
        ];
    }

    public function map($d): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $d->anggota->nama,
            $d->pengembalian->peminjaman->buku->judul,
            $d->hari_terlambat,
            'Rp ' . number_format($d->jumlah_denda, 0, ',', '.'),
            $d->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar',
            $d->tanggal_bayar ? $d->tanggal_bayar->format('d/m/Y') : '-',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '1e3a5f']
                ],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Denda';
    }
}