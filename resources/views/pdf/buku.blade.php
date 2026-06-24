<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Buku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
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
        <h2>Laporan Data Buku</h2>
        <small>Sistem Perpustakaan Digital &nbsp;|&nbsp; Dicetak: {{ now()->format('d F Y, H:i') }}</small>
    </div>

    <table>
        <thead>
            <tr>
                <th width="25">#</th>
                <th width="70">Kode</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th width="40">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $i => $b)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $b->kode_buku }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ $b->kategoris->pluck('nama_kategori')->join(', ') }}</td>
                    <td>
                        <span class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }}">
                            {{ $b->stok }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total: {{ $bukus->count() }} buku &nbsp;|&nbsp; Dicetak oleh: {{ auth()->user()->name }}
    </div>
</body>

</html>