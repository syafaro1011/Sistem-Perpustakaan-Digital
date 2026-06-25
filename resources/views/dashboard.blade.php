@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Dashboard
@endsection

@push('styles')
    <style>
        /* ── Stat Cards ─────────────────────────────────────── */
        .stat-card {
            border-radius: 12px;
            border: 1px solid var(--card-border, #d1f5e8);
            background: #fff;
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform .18s, box-shadow .18s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(15, 155, 122, .10);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 1.55rem;
            font-weight: 700;
            line-height: 1;
            color: #0d2b26;
        }

        .stat-value.small-val {
            font-size: 1.1rem;
        }

        .stat-label {
            font-size: .74rem;
            font-weight: 600;
            color: #94a3b8;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .stat-trend {
            font-size: .73rem;
            font-weight: 600;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* ── Section Header ─────────────────────────────────── */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .85rem 1rem;
            border-bottom: 1px solid #f0faf7;
        }

        .section-title {
            font-size: .875rem;
            font-weight: 700;
            color: #0d2b26;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .section-title i {
            font-size: 1rem;
        }

        /* ── Rank Badge ─────────────────────────────────────── */
        .rank-badge {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* ── Late Bubble ────────────────────────────────────── */
        .late-bubble {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fef2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            font-weight: 700;
            font-size: .75rem;
            flex-shrink: 0;
        }

        /* ── Greeting bar ───────────────────────────────────── */
        .greeting-bar {
            background: #fff;
            border: 1px solid #d1f5e8;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .greeting-name {
            font-size: 1rem;
            font-weight: 700;
            color: #0d2b26;
        }

        .greeting-date {
            font-size: .78rem;
            color: #64748b;
            font-weight: 500;
            margin-top: 2px;
        }

        .role-pill {
            font-size: .72rem;
            font-weight: 700;
            padding: .3rem .85rem;
            border-radius: 20px;
            letter-spacing: .3px;
        }

        /* ── Chart canvas ───────────────────────────────────── */
        .chart-wrap {
            position: relative;
        }
    </style>
@endpush

@section('content')

    {{-- ── Greeting Bar ─────────────────────────────────────────────── --}}
    <div class="greeting-bar">
        <div>
            <div class="greeting-name">Selamat datang, {{ auth()->user()->name }}! 👋</div>
            <div class="greeting-date">{{ now()->translatedFormat('l, d F Y') }}</div>
        </div>
        <span class="role-pill {{ auth()->user()->role === 'admin' ? 'bg-danger text-white' : 'text-white' }}"
            style="{{ auth()->user()->role !== 'admin' ? 'background:#0f9b7a;' : '' }}">
            {{ strtoupper(auth()->user()->role) }}
        </span>
    </div>

    {{-- ── Stat Row 1 : Koleksi ────────────────────────────────────── --}}
    <div class="row g-3 mb-3">

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf9;color:#0f9b7a;">
                    <i class="bi bi-journals"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalJudulBuku) }}</div>
                    <div class="stat-label">Judul Buku</div>
                    <div class="stat-trend" style="color:#0f9b7a;">
                        <i class="bi bi-arrow-up-right"></i>Koleksi aktif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#eff6ff;color:#3b82f6;">
                    <i class="bi bi-layers"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalBuku) }}</div>
                    <div class="stat-label">Total Stok Buku</div>
                    <div class="stat-trend" style="color:#3b82f6;">
                        <i class="bi bi-box-seam"></i>Unit tersedia
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalAnggota) }}</div>
                    <div class="stat-label">Total Anggota</div>
                    <div class="stat-trend" style="color:#16a34a;">
                        <i class="bi bi-person-check"></i>Terdaftar
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fefce8;color:#ca8a04;">
                    <i class="bi bi-tags"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalKategori) }}</div>
                    <div class="stat-label">Kategori Buku</div>
                    <div class="stat-trend" style="color:#ca8a04;">
                        <i class="bi bi-grid-3x3-gap"></i>Genre & topik
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Stat Row 2 : Sirkulasi ──────────────────────────────────── --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf9;color:#0f9b7a;">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $peminjamanAktif }}</div>
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-trend" style="color:#64748b;">
                        <i class="bi bi-clock"></i>Berjalan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $peminjamanSelesai }}</div>
                    <div class="stat-label">Selesai Dikembalikan</div>
                    <div class="stat-trend" style="color:#16a34a;">
                        <i class="bi bi-arrow-return-left"></i>Lunas
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef2f2;color:#dc2626;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div class="stat-value" style="color:#dc2626;">{{ $totalTerlambat }}</div>
                    <div class="stat-label">Terlambat</div>
                    <div class="stat-trend" style="color:#dc2626;">
                        <i class="bi bi-alarm"></i>Perlu tindakan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fff7ed;color:#ea580c;">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div>
                    <div class="stat-value small-val" style="color:#ea580c;">
                        Rp {{ number_format($dendaBelumBayar, 0, ',', '.') }}
                    </div>
                    <div class="stat-label">Denda Belum Lunas</div>
                    <div class="stat-trend" style="color:#ea580c;">
                        <i class="bi bi-exclamation-circle"></i>Belum bayar
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Charts Row ───────────────────────────────────────────────── --}}
    <div class="row g-3 mb-3">

        {{-- Bar Chart: Peminjaman per Bulan --}}
        <div class="col-md-8">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-bar-chart" style="color:#0f9b7a;"></i>
                        Peminjaman per Bulan — {{ now()->year }}
                    </div>
                </div>
                <div class="card-body chart-wrap">
                    <canvas id="chartPeminjaman" height="110"></canvas>
                </div>
            </div>
        </div>

        {{-- Doughnut: Distribusi Kategori --}}
        <div class="col-md-4">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-pie-chart" style="color:#ca8a04;"></i>
                        Distribusi Kategori
                    </div>
                </div>
                <div class="card-body d-flex flex-column align-items-center pb-2">
                    <canvas id="chartKategori" style="max-height:190px;"></canvas>
                    <div class="mt-3 w-100" style="font-size:.78rem;">
                        @foreach($kategoriData as $i => $k)
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-circle d-inline-block"
                                        style="width:8px;height:8px;background:var(--palette-{{ $i % 8 }});flex-shrink:0;"></span>
                                    <span class="text-truncate" style="max-width:130px;font-weight:500;color:#374151;">
                                        {{ $k->nama_kategori }}
                                    </span>
                                </div>
                                <span class="badge rounded-pill fw-bold"
                                    style="background:#f0fdf9;color:#0f9b7a;font-size:.7rem;">
                                    {{ $k->bukus_count }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Bottom Row ───────────────────────────────────────────────── --}}
    <div class="row g-3">

        {{-- Top 5 Buku Terpopuler --}}
        <div class="col-md-5">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-trophy" style="color:#ca8a04;"></i>Top 5 Buku Terpopuler
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled mb-0">
                        @forelse($topBuku as $i => $buku)
                            <li class="d-flex align-items-center gap-3 px-3 py-2 border-bottom"
                                style="border-color:#f0faf7!important;">
                                @if($i === 0)
                                    <div class="rank-badge" style="background:#fefce8;color:#ca8a04;font-size:.95rem;">🏆</div>
                                @else
                                    <div class="rank-badge" style="background:#f1f5f9;color:#64748b;">{{ $i + 1 }}</div>
                                @endif
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="fw-600 text-truncate" style="font-size:.84rem;font-weight:600;color:#0d2b26;">
                                        {{ $buku->judul }}
                                    </div>
                                    <small style="color:#94a3b8;font-weight:500;">{{ $buku->penulis }}</small>
                                </div>
                                <span class="badge rounded-pill fw-bold"
                                    style="background:#f0fdf9;color:#0f9b7a;font-size:.72rem;">
                                    {{ $buku->peminjamans_count }}x
                                </span>
                            </li>
                        @empty
                            <li class="text-center py-4" style="color:#94a3b8;font-size:.84rem;">
                                <i class="bi bi-inbox" style="font-size:1.5rem;display:block;margin-bottom:.4rem;"></i>
                                Belum ada data buku.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Peminjaman Terlambat --}}
        <div class="col-md-7">
            <div class="card h-100" style="border-color:#d1f5e8;">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-alarm" style="color:#dc2626;"></i>Peminjaman Terlambat
                    </div>
                    <a href="{{ route('peminjaman.index', ['status' => 'dipinjam']) }}" class="btn btn-sm fw-600"
                        style="font-size:.76rem;font-weight:700;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:7px;">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0" style="overflow-y:auto;max-height:260px;">
                    @forelse($terlambatList as $p)
                        @php $hari = now()->diffInDays($p->tanggal_kembali); @endphp
                        <div class="d-flex align-items-center gap-3 px-3 py-2 border-bottom"
                            style="border-color:#f0faf7!important;">
                            <div class="late-bubble">{{ $hari }}h</div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-semibold text-truncate" style="font-size:.84rem;color:#0d2b26;">
                                    {{ $p->anggota->nama }}
                                </div>
                                <small class="text-truncate d-block" style="color:#94a3b8;font-weight:500;">
                                    {{ $p->buku->judul }}
                                </small>
                            </div>
                            <div class="text-end flex-shrink-0">
                                <small class="d-block mb-1" style="color:#dc2626;font-weight:600;font-size:.75rem;">
                                    <i class="bi bi-calendar-x me-1"></i>{{ $p->tanggal_kembali->format('d/m/Y') }}
                                </small>
                                <a href="{{ route('pengembalian.create', ['peminjaman_id' => $p->id]) }}"
                                    class="btn btn-sm fw-bold"
                                    style="font-size:.72rem;background:#0f9b7a;color:#fff;border:none;border-radius:6px;padding:.22rem .65rem;">
                                    <i class="bi bi-arrow-return-left me-1"></i>Catat Kembali
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle"
                                style="font-size:2rem;color:#0f9b7a;display:block;margin-bottom:.4rem;"></i>
                            <span style="font-size:.84rem;color:#94a3b8;font-weight:500;">
                                Tidak ada peminjaman terlambat!
                            </span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Peminjaman Terbaru --}}
        <div class="col-12">
            <div class="card" style="border-color:#d1f5e8;">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-clock-history" style="color:#3b82f6;"></i>Peminjaman Terbaru
                    </div>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-sm fw-bold"
                        style="font-size:.76rem;font-weight:700;background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;border-radius:7px;">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr style="background:#fafffe;">
                                    <th class="px-3"
                                        style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                        Anggota</th>
                                    <th
                                        style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                        Buku</th>
                                    <th
                                        style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                        Tgl Pinjam</th>
                                    <th
                                        style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                        Batas Kembali</th>
                                    <th
                                        style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                        Status</th>
                                    <th style="border-bottom:2px solid #d1f5e8;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamanTerbaru as $p)
                                    @php
                                        $statusStyle = match ($p->status) {
                                            'dipinjam' => 'background:#eff6ff;color:#1d4ed8;',
                                            'dikembalikan' => 'background:#f0fdf4;color:#166534;',
                                            'terlambat' => 'background:#fef2f2;color:#991b1b;',
                                            default => 'background:#f1f5f9;color:#475569;',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="px-3">
                                            <div style="font-weight:600;font-size:.84rem;color:#0d2b26;">
                                                {{ $p->anggota->nama }}
                                            </div>
                                            <small style="color:#94a3b8;font-weight:500;">{{ $p->anggota->no_anggota }}</small>
                                        </td>
                                        <td>
                                            <div class="text-truncate"
                                                style="max-width:200px;font-size:.84rem;font-weight:500;color:#374151;">
                                                {{ $p->buku->judul }}
                                            </div>
                                        </td>
                                        <td style="font-size:.83rem;color:#374151;font-weight:500;">
                                            {{ $p->tanggal_pinjam->format('d/m/Y') }}
                                        </td>
                                        <td style="font-size:.83rem;color:#374151;font-weight:500;">
                                            {{ $p->tanggal_kembali->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 fw-bold" style="{{ $statusStyle }}font-size:.72rem;">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-sm"
                                                style="background:#f0fdf9;color:#0f9b7a;border:1px solid #d1f5e8;border-radius:6px;font-size:.78rem;font-weight:600;">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4" style="color:#94a3b8;font-size:.84rem;">
                                            <i class="bi bi-inbox"
                                                style="font-size:1.5rem;display:block;margin-bottom:.4rem;"></i>
                                            Belum ada data peminjaman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        /* ── Teal palette ──────────────────────────────────────── */
        const palette = [
            '#0f9b7a', '#3b82f6', '#f59e0b', '#a78bfa',
            '#ec4899', '#14b8a6', '#f97316', '#64748b'
        ];

        /* Inject CSS palette vars for legend dots */
        palette.forEach((c, i) => {
            document.documentElement.style.setProperty(`--palette-${i}`, c);
        });

        /* ── Bar Chart: Peminjaman per Bulan ───────────────────── */
        new Chart(document.getElementById('chartPeminjaman'), {
            type: 'bar',
            data: {
                labels: @json($labelBulan),
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: @json($dataBulan),
                    backgroundColor: 'rgba(15,155,122,.15)',
                    borderColor: '#0f9b7a',
                    borderWidth: 2,
                    borderRadius: 7,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0d2b26',
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        callbacks: { label: ctx => ` ${ctx.parsed.y} peminjaman` }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                            color: '#94a3b8'
                        },
                        grid: { color: 'rgba(0,0,0,.05)' }
                    },
                    x: {
                        ticks: {
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                            color: '#94a3b8'
                        },
                        grid: { display: false }
                    }
                }
            }
        });

        /* ── Doughnut: Distribusi Kategori ─────────────────────── */
        new Chart(document.getElementById('chartKategori'), {
            type: 'doughnut',
            data: {
                labels: @json($kategoriData->pluck('nama_kategori')),
                datasets: [{
                    data: @json($kategoriData->pluck('bukus_count')),
                    backgroundColor: palette,
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0d2b26',
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        callbacks: { label: ctx => ` ${ctx.label}: ${ctx.parsed} buku` }
                    }
                }
            }
        });
    </script>
@endpush