<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Denda</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
        }

        .header {
            background: #1e3a5f;
            color: white;
            padding: 16px 20px;
            margin-bottom: 16px;
        }

        .header h2 {
            font-size: 16px;
            margin-bottom: 2px;
        }

        .header small {
            font-size: 10px;
            opacity: .8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #1e3a5f;
            color: white;
            padding: 7px 8px;
            text-align: left;
            font-size: 10px;
        }

        tbody tr:nth-child(even) {
            background: #f1f5fb;
        }

        tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .total-row td {
            font-weight: bold;
            background: #f8fafc;
        }

        .footer {
            margin-top: 12px;
            font-size: 9px;
            color: #888;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Data Denda</h2>
        <small>Sistem Perpustakaan Digital &nbsp;|&nbsp; Dicetak: {{ now()->format('d F Y, H:i') }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th width="25">#</th>
                <th>Anggota</th>
                <th>Judul Buku</th>
                <th width="65">Terlambat</th>
                <th width="90">Jumlah Denda</th>
                <th width="75">Status</th>
                <th width="70">Tgl Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dendas as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->anggota->nama }}</td>
                    <td>{{ $d->pengembalian->peminjaman->buku->judul }}</td>
                    <td>{{ $d->hari_terlambat > 0 ? $d->hari_terlambat . ' hari' : '-' }}</td>
                    <td>Rp {{ number_format($d->jumlah_denda, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $d->status_bayar === 'sudah_bayar' ? 'badge-success' : 'badge-danger' }}">
                            {{ $d->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar' }}
                        </span>
                    </td>
                    <td>{{ $d->tanggal_bayar ? $d->tanggal_bayar->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" style="text-align:right">Total Denda:</td>
                <td>Rp {{ number_format($dendas->sum('jumlah_denda'), 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ auth()->user()->name }}
    </div>
</body>

</html>