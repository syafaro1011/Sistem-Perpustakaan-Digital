@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('peminjaman.index') }}" style="color:#0f9b7a;">Peminjaman</a>
    <span class="mx-1">/</span>Detail
@endsection

@push('styles')
    <style>
        .det-label {
            font-size: .71rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #94a3b8;
            margin-bottom: 2px;
        }

        .det-value {
            font-size: .875rem;
            font-weight: 600;
            color: #0d2b26;
        }

        .det-row {
            padding: .65rem 0;
            border-bottom: 1px solid #f0faf7;
        }

        .det-row:last-child {
            border-bottom: none;
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .85rem 1.1rem;
            border-bottom: 1px solid #d1f5e8;
            font-size: .83rem;
            font-weight: 700;
            color: #0d2b26;
        }

        .info-card-header i {
            font-size: 1rem;
        }
    </style>
@endpush

@section('content')

    @php
        $terlambat = $peminjaman->status === 'dipinjam' && now()->gt($peminjaman->tanggal_kembali);
        $selisih = $terlambat ? now()->diffInDays($peminjaman->tanggal_kembali) : 0;
        $kembali = $peminjaman->pengembalian ?? null;
    @endphp

    {{-- ── Status Banner (jika terlambat) ─────────────────────────── --}}
    @if($terlambat)
        <div class="d-flex align-items-center gap-3 mb-3 px-4 py-3 rounded-3"
            style="background:#fef3c7;border:1px solid #fde68a;">
            <i class="bi bi-exclamation-triangle-fill" style="color:#d97706;font-size:1.2rem;flex-shrink:0;"></i>
            <div>
                <div style="font-weight:700;font-size:.875rem;color:#92400e;">Peminjaman Terlambat!</div>
                <div style="font-size:.78rem;color:#a16207;font-weight:500;">
                    Buku ini melewati batas kembali {{ $selisih }} hari sejak
                    {{ $peminjaman->tanggal_kembali->format('d F Y') }}.
                </div>
            </div>
            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}"
                class="btn btn-sm ms-auto fw-bold"
                style="background:#d97706;color:#fff;border:none;border-radius:8px;font-size:.8rem;white-space:nowrap;">
                <i class="bi bi-arrow-return-left me-1"></i>Catat Sekarang
            </a>
        </div>
    @endif

    <div class="row g-3">

        {{-- ── Info Peminjaman ─────────────────────────────────── --}}
        <div class="col-md-6">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="info-card-header">
                    <i class="bi bi-arrow-left-right" style="color:#3b82f6;"></i>
                    Info Peminjaman
                    {{-- Status badge --}}
                    <span class="ms-auto badge fw-bold" style="{{ match (true) {
        $terlambat => 'background:#fef3c7;color:#92400e;',
        $peminjaman->status === 'dipinjam' => 'background:#eff6ff;color:#1d4ed8;',
        $peminjaman->status === 'dikembalikan' => 'background:#f0fdf4;color:#166534;',
        default => 'background:#fef2f2;color:#991b1b;',
    } }}font-size:.72rem;border-radius:20px;padding:.3rem .8rem;">
                        {{ $terlambat ? 'Terlambat' : ucfirst($peminjaman->status) }}
                    </span>
                </div>
                <div class="card-body px-4 py-2">
                    <div class="det-row">
                        <div class="det-label">Tanggal Pinjam</div>
                        <div class="det-value">{{ $peminjaman->tanggal_pinjam->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Batas Kembali</div>
                        <div class="det-value" style="{{ $terlambat ? 'color:#dc2626;' : '' }}">
                            {{ $peminjaman->tanggal_kembali->translatedFormat('d F Y') }}
                            @if($terlambat)
                                <span style="font-size:.75rem;font-weight:600;color:#dc2626;">
                                    ({{ $selisih }} hari terlambat)
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Dicatat oleh</div>
                        <div class="det-value">{{ $peminjaman->user->name }}</div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Dibuat pada</div>
                        <div class="det-value">{{ $peminjaman->created_at->translatedFormat('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Info Anggota ─────────────────────────────────────── --}}
        <div class="col-md-6">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="info-card-header">
                    <i class="bi bi-person" style="color:#0f9b7a;"></i>
                    Info Anggota
                </div>
                <div class="card-body px-4 py-2">
                    {{-- Avatar + nama --}}
                    <div class="d-flex align-items-center gap-3 py-2 border-bottom mb-1"
                        style="border-color:#f0faf7!important;">
                        <div
                            style="width:42px;height:42px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;font-size:.95rem;font-weight:700;color:#0f9b7a;flex-shrink:0;">
                            {{ strtoupper(substr($peminjaman->anggota->nama, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem;color:#0d2b26;">{{ $peminjaman->anggota->nama }}
                            </div>
                            <code
                                style="background:#f0fdf9;color:#0b7a60;padding:1px 6px;border-radius:4px;font-size:.75rem;font-weight:700;">
                                {{ $peminjaman->anggota->no_anggota }}
                            </code>
                        </div>
                        <span class="ms-auto badge fw-bold"
                            style="{{ $peminjaman->anggota->status === 'aktif' ? 'background:#f0fdf4;color:#166534;' : 'background:#f1f5f9;color:#475569;' }}font-size:.71rem;border-radius:20px;padding:.28rem .7rem;">
                            {{ ucfirst($peminjaman->anggota->status) }}
                        </span>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Email</div>
                        <div class="det-value">{{ $peminjaman->anggota->email }}</div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">No. HP</div>
                        <div class="det-value">{{ $peminjaman->anggota->no_hp ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Info Buku ────────────────────────────────────────── --}}
        <div class="col-md-6">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="info-card-header">
                    <i class="bi bi-journals" style="color:#ca8a04;"></i>
                    Info Buku
                </div>
                <div class="card-body px-4 py-2">
                    {{-- Cover + judul --}}
                    <div class="d-flex align-items-center gap-3 py-2 border-bottom mb-1"
                        style="border-color:#f0faf7!important;">
                        @if($peminjaman->buku->cover)
                            <img src="{{ Storage::url($peminjaman->buku->cover) }}" alt="Cover"
                                style="width:48px;height:62px;object-fit:cover;border-radius:6px;border:1px solid #d1f5e8;flex-shrink:0;">
                        @else
                            <div
                                style="width:48px;height:62px;border-radius:6px;background:#f0faf7;border:1px dashed #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-book" style="color:#d1f5e8;font-size:1.3rem;"></i>
                            </div>
                        @endif
                        <div>
                            <div style="font-weight:700;font-size:.875rem;color:#0d2b26;line-height:1.3;">
                                {{ $peminjaman->buku->judul }}
                            </div>
                            <div style="font-size:.78rem;color:#64748b;font-weight:500;margin-top:2px;">
                                {{ $peminjaman->buku->penulis }}
                            </div>
                            <code
                                style="background:#f0fdf9;color:#0b7a60;padding:1px 6px;border-radius:4px;font-size:.72rem;font-weight:700;margin-top:3px;display:inline-block;">
                                {{ $peminjaman->buku->kode_buku }}
                            </code>
                        </div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Penerbit</div>
                        <div class="det-value">{{ $peminjaman->buku->penerbit ?? '-' }}</div>
                    </div>
                    <div class="det-row">
                        <div class="det-label">Kategori</div>
                        <div class="d-flex flex-wrap gap-1 mt-1">
                            @forelse($peminjaman->buku->kategoris as $k)
                                <span
                                    style="background:#f0fdf9;color:#0b7a60;border:1px solid #d1f5e8;padding:2px 8px;border-radius:20px;font-size:.73rem;font-weight:700;">
                                    {{ $k->nama_kategori }}
                                </span>
                            @empty
                                <span style="font-size:.82rem;color:#94a3b8;">-</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Info Pengembalian & Denda ────────────────────────── --}}
        <div class="col-md-6">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="info-card-header">
                    <i class="bi bi-arrow-return-left" style="color:#8b5cf6;"></i>
                    Pengembalian & Denda
                </div>
                <div class="card-body px-4 py-2">
                    @if($kembali)
                        <div class="det-row">
                            <div class="det-label">Tgl Kembali Aktual</div>
                            <div class="det-value">{{ $kembali->tanggal_kembali_aktual->translatedFormat('d F Y') }}</div>
                        </div>
                        <div class="det-row">
                            <div class="det-label">Keterlambatan</div>
                            <div class="mt-1">
                                @if($kembali->hari_terlambat > 0)
                                    <span class="badge fw-bold"
                                        style="background:#fef2f2;color:#991b1b;font-size:.73rem;border-radius:6px;">
                                        <i class="bi bi-alarm me-1"></i>{{ $kembali->hari_terlambat }} hari
                                    </span>
                                @else
                                    <span class="badge fw-bold"
                                        style="background:#f0fdf4;color:#166534;font-size:.73rem;border-radius:6px;">
                                        <i class="bi bi-check-circle me-1"></i>Tepat Waktu
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="det-row">
                            <div class="det-label">Kondisi Buku</div>
                            <div class="mt-1">
                                @php
                                    $kondisiStyle = match ($kembali->kondisi_buku) {
                                        'baik' => 'background:#f0fdf4;color:#166534;',
                                        'rusak' => 'background:#fef3c7;color:#92400e;',
                                        'hilang' => 'background:#fef2f2;color:#991b1b;',
                                        default => 'background:#f1f5f9;color:#475569;',
                                    };
                                @endphp
                                <span class="badge fw-bold" style="{{ $kondisiStyle }}font-size:.73rem;border-radius:6px;">
                                    {{ ucfirst($kembali->kondisi_buku) }}
                                </span>
                            </div>
                        </div>
                        @if($kembali->catatan)
                            <div class="det-row">
                                <div class="det-label">Catatan</div>
                                <div style="font-size:.83rem;color:#374151;font-weight:500;margin-top:2px;">
                                    {{ $kembali->catatan }}
                                </div>
                            </div>
                        @endif
                        {{-- Denda --}}
                        @if($kembali->denda)
                            <div
                                style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:.75rem 1rem;margin-top:.5rem;">
                                <div
                                    style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#dc2626;margin-bottom:.5rem;">
                                    <i class="bi bi-cash-coin me-1"></i>Info Denda
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div style="font-size:1.1rem;font-weight:700;color:#dc2626;">
                                            Rp {{ number_format($kembali->denda->jumlah_denda, 0, ',', '.') }}
                                        </div>
                                        @if($kembali->denda->tanggal_bayar)
                                            <div style="font-size:.75rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                                                Dibayar: {{ $kembali->denda->tanggal_bayar->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="badge fw-bold"
                                        style="{{ $kembali->denda->status_bayar === 'sudah_bayar' ? 'background:#f0fdf4;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}font-size:.73rem;border-radius:20px;padding:.3rem .8rem;">
                                        {{ $kembali->denda->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="det-row">
                                <div class="det-label">Denda</div>
                                <span class="badge fw-bold"
                                    style="background:#f0fdf4;color:#166534;font-size:.73rem;border-radius:6px;">
                                    <i class="bi bi-check-circle me-1"></i>Tidak ada denda
                                </span>
                            </div>
                        @endif
                    @else
                        {{-- Belum dikembalikan --}}
                        <div class="text-center py-4">
                            <div
                                style="width:56px;height:56px;border-radius:50%;background:#fef3c7;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
                                <i class="bi bi-hourglass-split" style="font-size:1.4rem;color:#d97706;"></i>
                            </div>
                            <div style="font-weight:700;font-size:.875rem;color:#0d2b26;margin-bottom:.25rem;">Belum
                                Dikembalikan</div>
                            <div style="font-size:.78rem;color:#94a3b8;font-weight:500;margin-bottom:1rem;">
                                Buku ini masih dalam proses peminjaman.
                            </div>
                            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}"
                                class="btn btn-sm fw-bold"
                                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.82rem;padding:.45rem 1rem;">
                                <i class="bi bi-arrow-return-left me-1"></i>Catat Pengembalian
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- ── Bottom Actions ───────────────────────────────────────────── --}}
    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('peminjaman.index') }}" class="btn"
            style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.875rem;font-weight:600;padding:.5rem 1.1rem;">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        @if($peminjaman->status === 'dipinjam')
            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}" class="btn fw-bold"
                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.5rem 1.2rem;">
                <i class="bi bi-arrow-return-left me-1"></i>Catat Pengembalian
            </a>
        @endif
    </div>

@endsection