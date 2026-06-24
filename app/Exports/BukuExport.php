<?php
namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function collection()
    {
        return Buku::with('kategoris')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Buku',
            'Judul',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'ISBN',
            'Kategori',
            'Stok'
        ];
    }

    public function map($buku): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $buku->kode_buku,
            $buku->judul,
            $buku->penulis,
            $buku->penerbit ?? '-',
            $buku->tahun_terbit ?? '-',
            $buku->isbn ?? '-',
            $buku->kategoris->pluck('nama_kategori')->join(', '),
            $buku->stok,
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
        return 'Data Buku';
    }
}