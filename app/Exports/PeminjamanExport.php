<?php
namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function collection()
    {
        return Peminjaman::with(['anggota', 'buku', 'user'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Anggota',
            'No. Anggota',
            'Judul Buku',
            'Tgl Pinjam',
            'Batas Kembali',
            'Status',
            'Dicatat Oleh'
        ];
    }

    public function map($p): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $p->anggota->nama,
            $p->anggota->no_anggota,
            $p->buku->judul,
            $p->tanggal_pinjam->format('d/m/Y'),
            $p->tanggal_kembali->format('d/m/Y'),
            ucfirst($p->status),
            $p->user->name,
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
        return 'Data Peminjaman';
    }
}