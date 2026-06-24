<?php
namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnggotaExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function collection()
    {
        return Anggota::withCount('peminjamans')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Anggota',
            'Nama',
            'Email',
            'No. HP',
            'Alamat',
            'Status',
            'Total Peminjaman'
        ];
    }

    public function map($a): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $a->no_anggota,
            $a->nama,
            $a->email,
            $a->no_hp ?? '-',
            $a->alamat ?? '-',
            ucfirst($a->status),
            $a->peminjamans_count,
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
        return 'Data Anggota';
    }
}