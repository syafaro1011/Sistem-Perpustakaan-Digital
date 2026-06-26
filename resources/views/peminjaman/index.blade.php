@extends('layouts.app')
@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Peminjaman
@endsection

@section('content')

    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
            style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
            <div>
                <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Peminjaman</div>
                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    Kelola transaksi peminjaman buku
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('peminjaman.create') }}" class="btn btn-sm fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.8rem;padding:.4rem .9rem;">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Peminjaman
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle"
                        style="background:#f0faf7;color:#0f9b7a;border:1px solid #d1f5e8;border-radius:8px;font-size:.8rem;font-weight:600;"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border shadow-sm mt-1"
                        style="border-color:#d1f5e8!important;min-width:170px;">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('export.excel.peminjaman') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-excel me-2" style="color:#16a34a;"></i>Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('export.pdf.peminjaman') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-pdf me-2" style="color:#dc2626;"></i>Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ── Search + Filter ────────────────────────────────── --}}
        <div class="px-4 pt-3 pb-2">
            <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
                <div class="input-group" style="max-width:320px;">
                    <span class="input-group-text"
                        style="background:#f0faf7;border-color:#d1f5e8;border-right:none;border-radius:8px 0 0 8px;">
                        <i class="bi bi-search" style="color:#0f9b7a;font-size:.85rem;"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari anggota / buku..."
                        value="{{ request('search') }}"
                        style="border-color:#d1f5e8;border-left:none;border-radius:0 8px 8px 0;font-size:.85rem;">
                </div>
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()"
                    style="max-width:155px;border-color:#d1f5e8;border-radius:8px;font-size:.83rem;font-weight:600;color:#374151;">
                    <option value="">Semua Status</option>
                    <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan
                    </option>
                    <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </form>
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
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Tgl Pinjam</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Batas Kembali</th>
                            <th
                                style="width:125px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Status</th>
                            <th
                                style="width:105px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $i => $p)
                            @php
                                $terlambat = $p->status === 'dipinjam' && now()->gt($p->tanggal_kembali);
                                $selisih = $terlambat ? now()->diffInDays($p->tanggal_kembali) : 0;
                            @endphp
                            <tr style="border-bottom:1px solid #f0faf7;{{ $terlambat ? 'background:#fffbeb;' : '' }}">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $peminjamans->firstItem() + $i }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            style="width:32px;height:32px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;color:#0f9b7a;">
                                            {{ strtoupper(substr($p->anggota->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:700;font-size:.84rem;color:#0d2b26;">{{ $p->anggota->nama }}
                                            </div>
                                            <div style="font-size:.72rem;color:#94a3b8;font-weight:500;">
                                                {{ $p->anggota->no_anggota }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate"
                                        style="max-width:180px;font-size:.84rem;font-weight:600;color:#374151;">
                                        {{ $p->buku->judul }}
                                    </div>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:1px 5px;border-radius:4px;font-size:.71rem;">
                                        {{ $p->buku->kode_buku }}
                                    </code>
                                </td>
                                <td style="font-size:.83rem;font-weight:500;color:#374151;">
                                    {{ $p->tanggal_pinjam->format('d/m/Y') }}
                                </td>
                                <td>
                                    <div
                                        style="font-size:.83rem;font-weight:{{ $terlambat ? '700' : '500' }};color:{{ $terlambat ? '#dc2626' : '#374151' }};">
                                        {{ $p->tanggal_kembali->format('d/m/Y') }}
                                    </div>
                                    @if($terlambat)
                                        <div style="font-size:.71rem;color:#dc2626;font-weight:600;">
                                            <i class="bi bi-alarm me-1"></i>{{ $selisih }} hari terlambat
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusStyle = match (true) {
                                            $terlambat => 'background:#fef3c7;color:#92400e;',
                                            $p->status === 'dipinjam' => 'background:#eff6ff;color:#1d4ed8;',
                                            $p->status === 'dikembalikan' => 'background:#f0fdf4;color:#166534;',
                                            $p->status === 'terlambat' => 'background:#fef2f2;color:#991b1b;',
                                            default => 'background:#f1f5f9;color:#475569;',
                                        };
                                    @endphp
                                    <span class="badge fw-bold"
                                        style="{{ $statusStyle }}font-size:.72rem;border-radius:20px;padding:.3rem .75rem;">
                                        @if($terlambat)
                                            <i class="bi bi-exclamation-triangle me-1"></i>Terlambat
                                        @else
                                            {{ ucfirst($p->status) }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-end">
                                        <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-sm"
                                            style="background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;border-radius:6px;padding:.28rem .55rem;"
                                            title="Detail">
                                            <i class="bi bi-eye" style="font-size:.82rem;"></i>
                                        </a>
                                        @if($p->status === 'dipinjam')
                                            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $p->id]) }}"
                                                class="btn btn-sm"
                                                style="background:#f0fdf9;color:#0f9b7a;border:1px solid #d1f5e8;border-radius:6px;padding:.28rem .55rem;"
                                                title="Catat Pengembalian">
                                                <i class="bi bi-arrow-return-left" style="font-size:.82rem;"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;padding:.28rem .55rem;"
                                                title="Hapus" data-confirm="Hapus data peminjaman ini?">
                                                <i class="bi bi-trash" style="font-size:.82rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-arrow-left-right d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data
                                        peminjaman.</span><br>
                                    <a href="{{ route('peminjaman.create') }}" class="btn btn-sm mt-2 fw-bold"
                                        style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                                        <i class="bi bi-plus-lg me-1"></i>Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($peminjamans->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $peminjamans->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection