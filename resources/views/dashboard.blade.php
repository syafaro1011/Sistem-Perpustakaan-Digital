@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
    <style>
        .stat-card {
            border-radius: 12px;
            border: none;
            transition: transform .15s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: .78rem;
            color: #6c757d;
            margin-top: 2px;
        }

        .chart-card {
            border: none;
            border-radius: 12px;
        }
    </style>
@endpush

@section('content')

    {{-- ── Greeting ─────────────────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-0">Selamat datang, {{ auth()->user()->name }}! 👋</h5>
            <small class="text-muted">{{ now()->translatedFormat('l, d F Y') }}</small>
        </div>
        <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 'primary' }} px-3 py-2">
            {{ strtoupper(auth()->user()->role) }}
        </span>
    </div>

    {{-- ── Stat Cards Row 1 ─────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">

        {{-- Total Judul Buku --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-journals"></i>
                    </div>
                    <div>
                        <div class="stat-value text-primary">{{ number_format($totalJudulBuku) }}</div>
                        <div class="stat-label">Judul Buku</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Stok --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="bi bi-layers"></i>
                    </div>
                    <div>
                        <div class="stat-value text-info">{{ number_format($totalBuku) }}</div>
                        <div class="stat-label">Total Stok Buku</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Anggota --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <div class="stat-value text-success">{{ number_format($totalAnggota) }}</div>
                        <div class="stat-label">Total Anggota</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div>
                        <div class="stat-value text-warning">{{ number_format($totalKategori) }}</div>
                        <div class="stat-label">Kategori Buku</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Stat Cards Row 2 ─────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">

        {{-- Peminjaman Aktif --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <div>
                        <div class="stat-value text-primary">{{ $peminjamanAktif }}</div>
                        <div class="stat-label">Sedang Dipinjam</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Peminjaman Selesai --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <div class="stat-value text-success">{{ $peminjamanSelesai }}</div>
                        <div class="stat-label">Selesai Dikembalikan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terlambat --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div>
                        <div class="stat-value text-danger">{{ $totalTerlambat }}</div>
                        <div class="stat-label">Terlambat</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Denda Belum Bayar --}}
        <div class="col-6 col-md-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div>
                        <div class="stat-value text-danger" style="font-size:1.1rem">
                            Rp {{ number_format($dendaBelumBayar, 0, ',', '.') }}
                        </div>
                        <div class="stat-label">Denda Belum Lunas</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Charts Row ───────────────────────────────────────────────── --}}
    <div class="row g-3 mb-4">

        {{-- Grafik Peminjaman per Bulan --}}
        <div class="col-md-8">
            <div class="card chart-card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-bar-chart me-2 text-primary"></i>
                        Peminjaman per Bulan ({{ now()->year }})
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="chartPeminjaman" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- Distribusi Kategori --}}
        <div class="col-md-4">
            <div class="card chart-card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-pie-chart me-2 text-warning"></i>
                        Distribusi Kategori
                    </h6>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <canvas id="chartKategori" style="max-height:200px"></canvas>
                    <div class="mt-3 w-100">
                        @foreach($kategoriData as $k)
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-truncate" style="max-width:140px">{{ $k->nama_kategori }}</small>
                                <span class="badge bg-secondary rounded-pill">{{ $k->bukus_count }}</span>
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
            <div class="card chart-card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-trophy me-2 text-warning"></i>Top 5 Buku Terpopuler
                    </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($topBuku as $i => $buku)
                            <li class="list-group-item d-flex align-items-center gap-3 px-3 py-2">
                                <span class="fw-bold text-{{ $i === 0 ? 'warning' : 'muted' }}"
                                    style="width:20px;text-align:center">
                                    {{ $i === 0 ? '🏆' : ($i + 1) }}
                                </span>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="fw-semibold text-truncate small">{{ $buku->judul }}</div>
                                    <small class="text-muted">{{ $buku->penulis }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $buku->peminjamans_count }}x
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- Peminjaman Terlambat --}}
        <div class="col-md-7">
            <div class="card chart-card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-alarm me-2 text-danger"></i>Peminjaman Terlambat
                    </h6>
                    <a href="{{ route('peminjaman.index', ['status' => 'dipinjam']) }}"
                        class="btn btn-outline-danger btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @forelse($terlambatList as $p)
                        @php $hari = now()->diffInDays($p->tanggal_kembali); @endphp
                        <div class="d-flex align-items-center gap-3 px-3 py-2 border-bottom">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center
                                        justify-content-center text-danger fw-bold"
                                style="width:40px;height:40px;flex-shrink:0;font-size:.8rem">
                                {{ $hari }}h
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-semibold small text-truncate">{{ $p->anggota->nama }}</div>
                                <small class="text-muted text-truncate d-block">{{ $p->buku->judul }}</small>
                            </div>
                            <div class="text-end flex-shrink-0">
                                <small class="text-danger d-block">
                                    {{ $p->tanggal_kembali->format('d/m/Y') }}
                                </small>
                                <a href="{{ route('pengembalian.create', ['peminjaman_id' => $p->id]) }}"
                                    class="btn btn-success btn-sm py-0 px-2 mt-1" style="font-size:.75rem">
                                    Catat Kembali
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-check-circle text-success" style="font-size:2rem"></i>
                            <p class="mt-2 mb-0 small">Tidak ada peminjaman terlambat!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Peminjaman Terbaru --}}
        <div class="col-12">
            <div class="card chart-card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-clock-history me-2 text-info"></i>Peminjaman Terbaru
                    </h6>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3">Anggota</th>
                                    <th>Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamanTerbaru as $p)
                                    @php
                                        $colors = ['dipinjam' => 'primary', 'dikembalikan' => 'success', 'terlambat' => 'danger'];
                                    @endphp
                                    <tr>
                                        <td class="px-3">
                                            <div class="fw-semibold small">{{ $p->anggota->nama }}</div>
                                            <small class="text-muted">{{ $p->anggota->no_anggota }}</small>
                                        </td>
                                        <td>
                                            <div class="small text-truncate" style="max-width:180px">
                                                {{ $p->buku->judul }}
                                            </div>
                                        </td>
                                        <td class="small">{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                        <td class="small">{{ $p->tanggal_kembali->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $colors[$p->status] ?? 'secondary' }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('peminjaman.show', $p) }}"
                                                class="btn btn-sm btn-outline-info py-0 px-2">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
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
        // ── Warna palette ──────────────────────────────────────────────
        const palette = [
            '#4f6ef7', '#f7934f', '#4fc2f7', '#a78bfa',
            '#34d399', '#f87171', '#fbbf24', '#60a5fa'
        ];

        // ── Chart 1: Peminjaman per Bulan (Bar) ───────────────────────
        new Chart(document.getElementById('chartPeminjaman'), {
            type: 'bar',
            data: {
                labels: @json($labelBulan),
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: @json($dataBulan),
                    backgroundColor: 'rgba(79,110,247,0.15)',
                    borderColor: '#4f6ef7',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.parsed.y} peminjaman`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // ── Chart 2: Distribusi Kategori (Doughnut) ───────────────────
        new Chart(document.getElementById('chartKategori'), {
            type: 'doughnut',
            data: {
                labels: @json($kategoriData->pluck('nama_kategori')),
                datasets: [{
                    data: @json($kategoriData->pluck('bukus_count')),
                    backgroundColor: palette,
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.label}: ${ctx.parsed} buku`
                        }
                    }
                }
            }
        });
    </script>
@endpush