@extends('layouts.app')
@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('buku.index') }}" style="color:#0f9b7a;">Buku</a>
    <span class="mx-1">/</span>Detail
@endsection

@push('styles')
    <style>
        .detail-label {
            font-size: .73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #94a3b8;
            margin-bottom: 3px;
        }

        .detail-value {
            font-size: .88rem;
            font-weight: 600;
            color: #0d2b26;
        }

        .detail-row {
            padding: .75rem 0;
            border-bottom: 1px solid #f0faf7;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .info-chip {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .3rem .75rem;
            border-radius: 20px;
            font-size: .78rem;
            font-weight: 700;
        }
    </style>
@endpush

@section('content')

    <div class="row g-4">

        {{-- ── Kiri: Cover Panel ─────────────────────────────── --}}
        <div class="col-md-4 col-lg-3">
            <div class="card text-center" style="border-color:#d1f5e8;">
                <div class="card-body p-3">

                    {{-- Cover Image --}}
                    @if($buku->cover)
                        <img src="{{ Storage::url($buku->cover) }}" alt="Cover {{ $buku->judul }}" class="img-fluid mb-3"
                            style="max-height:260px;object-fit:cover;border-radius:10px;border:1px solid #d1f5e8;">
                    @else
                        <div class="d-flex align-items-center justify-content-center mb-3"
                            style="height:200px;background:#f0faf7;border-radius:10px;border:1px dashed #d1f5e8;">
                            <div>
                                <i class="bi bi-book d-block mb-1" style="font-size:3.5rem;color:#d1f5e8;"></i>
                                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;">Tidak ada cover</div>
                            </div>
                        </div>
                    @endif

                    {{-- Stok badge --}}
                    <div class="mb-3">
                        <span class="info-chip"
                            style="{{ $buku->stok > 0 ? 'background:#f0fdf4;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                            <i class="bi bi-{{ $buku->stok > 0 ? 'check-circle' : 'x-circle' }}"></i>
                            Stok: {{ $buku->stok }} unit
                        </span>
                    </div>

                    {{-- Kode Buku --}}
                    <div class="mb-3">
                        <code
                            style="background:#f0fdf9;color:#0b7a60;padding:4px 12px;border-radius:6px;font-size:.82rem;font-weight:700;">
                            {{ $buku->kode_buku }}
                        </code>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('buku.edit', $buku) }}" class="btn fw-bold"
                            style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.83rem;padding:.5rem;">
                            <i class="bi bi-pencil me-1"></i>Edit Buku
                        </a>
                        <form action="{{ route('buku.destroy', $buku) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn w-100 fw-bold"
                                style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:8px;font-size:.83rem;padding:.5rem;"
                                data-confirm="Hapus buku &quot;{{ $buku->judul }}&quot;? Tindakan ini tidak dapat dibatalkan.">
                                <i class="bi bi-trash me-1"></i>Hapus Buku
                            </button>
                        </form>
                        <a href="{{ route('buku.index') }}" class="btn fw-600"
                            style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.83rem;font-weight:600;padding:.5rem;">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Kanan: Detail Info ─────────────────────────────── --}}
        <div class="col-md-8 col-lg-9">

            {{-- Judul & Penulis --}}
            <div class="card mb-3" style="border-color:#d1f5e8;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-1" style="color:#0d2b26;">{{ $buku->judul }}</h4>
                    <div style="font-size:.9rem;color:#64748b;font-weight:500;margin-bottom:.85rem;">
                        <i class="bi bi-person me-1"></i>{{ $buku->penulis }}
                    </div>

                    {{-- Kategori pills --}}
                    <div class="d-flex flex-wrap gap-1">
                        @forelse($buku->kategoris as $k)
                            <span
                                style="background:#f0fdf9;color:#0b7a60;border:1px solid #d1f5e8;padding:3px 10px;border-radius:20px;font-size:.76rem;font-weight:700;">
                                <i class="bi bi-tag me-1"></i>{{ $k->nama_kategori }}
                            </span>
                        @empty
                            <span style="font-size:.82rem;color:#94a3b8;font-weight:500;">Belum ada kategori</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Info Detail --}}
            <div class="card mb-3" style="border-color:#d1f5e8;">
                <div class="card-body p-0">
                    <div class="px-4 py-2"
                        style="background:#fafffe;border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
                        <span
                            style="font-size:.76rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:#0f9b7a;">
                            <i class="bi bi-info-circle me-1"></i>Informasi Lengkap
                        </span>
                    </div>
                    <div class="px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <div class="detail-label">Kode Buku</div>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:2px 8px;border-radius:5px;font-size:.82rem;font-weight:700;">
                                        {{ $buku->kode_buku }}
                                    </code>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Penerbit</div>
                                    <div class="detail-value">{{ $buku->penerbit ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Tahun Terbit</div>
                                    <div class="detail-value">{{ $buku->tahun_terbit ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <div class="detail-label">ISBN</div>
                                    <div class="detail-value">{{ $buku->isbn ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Stok Tersedia</div>
                                    <div class="detail-value">
                                        <span class="info-chip"
                                            style="{{ $buku->stok > 0 ? 'background:#f0fdf4;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}">
                                            {{ $buku->stok }} unit
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Ditambahkan</div>
                                    <div class="detail-value">
                                        {{ $buku->created_at?->translatedFormat('d F Y') ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sinopsis --}}
            @if($buku->sinopsis)
                <div class="card" style="border-color:#d1f5e8;">
                    <div class="card-body p-4">
                        <div
                            style="font-size:.76rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:#0f9b7a;margin-bottom:.65rem;">
                            <i class="bi bi-text-paragraph me-1"></i>Sinopsis
                        </div>
                        <p style="font-size:.875rem;color:#374151;line-height:1.7;margin:0;">{{ $buku->sinopsis }}</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection