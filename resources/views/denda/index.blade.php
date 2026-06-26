@extends('layouts.app')
@section('title', 'Data Denda')
@section('page-title', 'Data Denda')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Denda
@endsection

@section('content')

    {{-- ── Summary Cards ───────────────────────────────────────────── --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card" style="border-color:#d1f5e8;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div
                        style="width:42px;height:42px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-cash-coin" style="color:#dc2626;font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <div
                            style="font-size:.69rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">
                            Total Denda</div>
                        <div style="font-size:1rem;font-weight:700;color:#0d2b26;line-height:1.2;">
                            Rp {{ number_format($dendas->sum('jumlah_denda'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card" style="border-color:#d1f5e8;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div
                        style="width:42px;height:42px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-hourglass-split" style="color:#dc2626;font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <div
                            style="font-size:.69rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">
                            Belum Lunas</div>
                        <div style="font-size:1rem;font-weight:700;color:#dc2626;line-height:1.2;">
                            Rp
                            {{ number_format($dendas->where('status_bayar', 'belum_bayar')->sum('jumlah_denda'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card" style="border-color:#d1f5e8;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div
                        style="width:42px;height:42px;border-radius:10px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-check-circle" style="color:#16a34a;font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <div
                            style="font-size:.69rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">
                            Sudah Lunas</div>
                        <div style="font-size:1rem;font-weight:700;color:#166534;line-height:1.2;">
                            Rp
                            {{ number_format($dendas->where('status_bayar', 'sudah_bayar')->sum('jumlah_denda'), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card" style="border-color:#d1f5e8;">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div
                        style="width:42px;height:42px;border-radius:10px;background:#f0fdf9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-receipt" style="color:#0f9b7a;font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <div
                            style="font-size:.69rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;">
                            Total Transaksi</div>
                        <div style="font-size:1rem;font-weight:700;color:#0d2b26;line-height:1.2;">
                            {{ $dendas->total() }} denda
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Main Card ────────────────────────────────────────────────── --}}
    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="card-header bg-white py-3 px-4" style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Denda</div>
                    <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                        Kelola pembayaran denda keterlambatan &amp; kerusakan buku
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    {{-- Filter status --}}
                    <form method="GET" class="d-flex gap-2">
                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()"
                            style="max-width:150px;border-color:#d1f5e8;border-radius:8px;font-size:.83rem;font-weight:600;color:#374151;">
                            <option value="">Semua Status</option>
                            <option value="belum_bayar" {{ request('status') === 'belum_bayar' ? 'selected' : '' }}>Belum
                                Bayar</option>
                            <option value="sudah_bayar" {{ request('status') === 'sudah_bayar' ? 'selected' : '' }}>Sudah
                                Bayar</option>
                        </select>
                    </form>
                    {{-- Export --}}
                    <div class="dropdown">
                        <button class="btn btn-sm dropdown-toggle"
                            style="background:#f0faf7;color:#0f9b7a;border:1px solid #d1f5e8;border-radius:8px;font-size:.8rem;font-weight:600;"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-download me-1"></i>Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border shadow-sm mt-1"
                            style="border-color:#d1f5e8!important;min-width:170px;">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('export.excel.denda') }}"
                                    style="font-size:.83rem;font-weight:500;">
                                    <i class="bi bi-file-earmark-excel me-2" style="color:#16a34a;"></i>Export Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('export.pdf.denda') }}"
                                    style="font-size:.83rem;font-weight:500;">
                                    <i class="bi bi-file-earmark-pdf me-2" style="color:#dc2626;"></i>Export PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Table ───────────────────────────────────────────── --}}
        <div class="card-body p-0 px-4 pb-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr style="background:#fafffe;">
                            <th
                                style="width:46px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                #</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Anggota</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Buku</th>
                            <th
                                style="width:130px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Keterlambatan</th>
                            <th
                                style="width:150px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Jumlah Denda</th>
                            <th
                                style="width:115px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Status</th>
                            <th
                                style="width:110px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Tgl Bayar</th>
                            <th
                                style="width:90px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dendas as $i => $d)
                            <tr
                                style="border-bottom:1px solid #f0faf7;{{ $d->status_bayar === 'belum_bayar' ? 'background:#fffbf5;' : '' }}">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $dendas->firstItem() + $i }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            style="width:32px;height:32px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;color:#0f9b7a;">
                                            {{ strtoupper(substr($d->anggota->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:700;font-size:.84rem;color:#0d2b26;">{{ $d->anggota->nama }}
                                            </div>
                                            <div style="font-size:.72rem;color:#94a3b8;font-weight:500;">
                                                {{ $d->anggota->no_anggota }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate"
                                        style="max-width:180px;font-size:.84rem;font-weight:600;color:#374151;">
                                        {{ $d->pengembalian->peminjaman->buku->judul }}
                                    </div>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:1px 5px;border-radius:4px;font-size:.71rem;">
                                        {{ $d->pengembalian->peminjaman->buku->kode_buku }}
                                    </code>
                                </td>
                                <td class="text-center">
                                    @if($d->hari_terlambat > 0)
                                        <span class="badge fw-bold"
                                            style="background:#fef2f2;color:#991b1b;font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                            <i class="bi bi-alarm me-1"></i>{{ $d->hari_terlambat }} hari
                                        </span>
                                    @else
                                        <span style="font-size:.8rem;color:#94a3b8;font-weight:500;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div
                                        style="font-size:.9rem;font-weight:700;color:{{ $d->status_bayar === 'belum_bayar' ? '#dc2626' : '#166534' }};">
                                        Rp {{ number_format($d->jumlah_denda, 0, ',', '.') }}
                                    </div>
                                    {{-- Breakdown denda jika ada info --}}
                                    @if(isset($d->pengembalian) && $d->pengembalian->kondisi_buku !== 'baik')
                                        <div style="font-size:.72rem;color:#94a3b8;font-weight:500;">
                                            +kondisi {{ $d->pengembalian->kondisi_buku }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($d->status_bayar === 'sudah_bayar')
                                        <span class="badge fw-bold"
                                            style="background:#f0fdf4;color:#166534;font-size:.73rem;border-radius:20px;padding:.3rem .8rem;">
                                            <i class="bi bi-check-circle me-1"></i>Lunas
                                        </span>
                                    @else
                                        <span class="badge fw-bold"
                                            style="background:#fef2f2;color:#991b1b;font-size:.73rem;border-radius:20px;padding:.3rem .8rem;">
                                            <i class="bi bi-clock me-1"></i>Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td style="font-size:.83rem;font-weight:500;color:#374151;">
                                    {{ $d->tanggal_bayar ? $d->tanggal_bayar->format('d/m/Y') : '—' }}
                                </td>
                                <td>
                                    @if($d->status_bayar === 'belum_bayar')
                                        <form action="{{ route('denda.bayar', $d) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm fw-bold"
                                                style="background:#0f9b7a;color:#fff;border:none;border-radius:6px;font-size:.78rem;padding:.3rem .75rem;white-space:nowrap;"
                                                data-confirm="Konfirmasi pembayaran denda Rp {{ number_format($d->jumlah_denda, 0, ',', '.') }} dari {{ $d->anggota->nama }}?">
                                                <i class="bi bi-cash me-1"></i>Bayar
                                            </button>
                                        </form>
                                    @else
                                        <span
                                            style="font-size:.78rem;color:#94a3b8;font-weight:600;display:flex;align-items:center;gap:.3rem;">
                                            <i class="bi bi-check2-circle" style="color:#16a34a;"></i>Lunas
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-cash-coin d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data denda.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($dendas->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $dendas->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection