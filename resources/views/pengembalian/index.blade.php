@extends('layouts.app')
@section('title', 'Data Pengembalian')
@section('page-title', 'Data Pengembalian')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Pengembalian
@endsection

@section('content')

    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
            style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
            <div>
                <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Pengembalian</div>
                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    Riwayat pengembalian buku oleh anggota
                </div>
            </div>
            <a href="{{ route('pengembalian.create') }}" class="btn btn-sm fw-bold"
                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.8rem;padding:.4rem .9rem;">
                <i class="bi bi-arrow-return-left me-1"></i>Catat Pengembalian
            </a>
        </div>

        {{-- ── Search ──────────────────────────────────────────── --}}
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
                <select name="kondisi" class="form-select form-select-sm" onchange="this.form.submit()"
                    style="max-width:145px;border-color:#d1f5e8;border-radius:8px;font-size:.83rem;font-weight:600;color:#374151;">
                    <option value="">Semua Kondisi</option>
                    <option value="baik" {{ request('kondisi') === 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak" {{ request('kondisi') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="hilang" {{ request('kondisi') === 'hilang' ? 'selected' : '' }}>Hilang</option>
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
                                Tgl Kembali</th>
                            <th
                                style="width:130px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Keterlambatan</th>
                            <th
                                style="width:100px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Kondisi</th>
                            <th
                                style="width:140px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $i => $p)
                            <tr style="border-bottom:1px solid #f0faf7;">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $pengembalians->firstItem() + $i }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            style="width:32px;height:32px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.75rem;font-weight:700;color:#0f9b7a;">
                                            {{ strtoupper(substr($p->peminjaman->anggota->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:700;font-size:.84rem;color:#0d2b26;">
                                                {{ $p->peminjaman->anggota->nama }}
                                            </div>
                                            <div style="font-size:.72rem;color:#94a3b8;font-weight:500;">
                                                {{ $p->peminjaman->anggota->no_anggota }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-truncate"
                                        style="max-width:170px;font-size:.84rem;font-weight:600;color:#374151;">
                                        {{ $p->peminjaman->buku->judul }}
                                    </div>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:1px 5px;border-radius:4px;font-size:.71rem;">
                                        {{ $p->peminjaman->buku->kode_buku }}
                                    </code>
                                </td>
                                <td style="font-size:.83rem;font-weight:500;color:#374151;">
                                    {{ $p->tanggal_kembali_aktual->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    @if($p->hari_terlambat > 0)
                                        <span class="badge fw-bold"
                                            style="background:#fef2f2;color:#991b1b;font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                            <i class="bi bi-alarm me-1"></i>{{ $p->hari_terlambat }} hari
                                        </span>
                                    @else
                                        <span class="badge fw-bold"
                                            style="background:#f0fdf4;color:#166534;font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                            <i class="bi bi-check-circle me-1"></i>Tepat Waktu
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $kondisiStyle = match ($p->kondisi_buku) {
                                            'baik' => 'background:#f0fdf4;color:#166534;',
                                            'rusak' => 'background:#fef3c7;color:#92400e;',
                                            'hilang' => 'background:#fef2f2;color:#991b1b;',
                                            default => 'background:#f1f5f9;color:#475569;',
                                        };
                                    @endphp
                                    <span class="badge fw-bold"
                                        style="{{ $kondisiStyle }}font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                        {{ ucfirst($p->kondisi_buku) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->denda)
                                        <div
                                            style="font-size:.83rem;font-weight:700;color:{{ $p->denda->status_bayar === 'sudah_bayar' ? '#166534' : '#dc2626' }};">
                                            Rp {{ number_format($p->denda->jumlah_denda, 0, ',', '.') }}
                                        </div>
                                        <span class="badge fw-bold"
                                            style="{{ $p->denda->status_bayar === 'sudah_bayar' ? 'background:#f0fdf4;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}font-size:.69rem;border-radius:5px;">
                                            {{ $p->denda->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar' }}
                                        </span>
                                    @else
                                        <span style="font-size:.8rem;color:#94a3b8;font-weight:500;">Tidak ada denda</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-arrow-return-left d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data
                                        pengembalian.</span><br>
                                    <a href="{{ route('pengembalian.create') }}" class="btn btn-sm mt-2 fw-bold"
                                        style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                                        <i class="bi bi-plus-lg me-1"></i>Catat Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pengembalians->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $pengembalians->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection