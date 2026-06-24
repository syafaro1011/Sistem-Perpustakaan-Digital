@extends('layouts.app')
@section('title', 'Data Denda')
@section('page-title', 'Data Denda')

@section('breadcrumb')
    <li class="breadcrumb-item active">Denda</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Denda</h6>

            <!-- Export -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('export.excel.denda') }}">
                            <i class="bi bi-file-earmark-excel text-success me-2"></i>Export Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('export.pdf.denda') }}">
                            <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export PDF
                        </a>
                    </li>
                </ul>
            </div>

            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select form-select-sm" style="max-width:160px"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="belum_bayar" {{ request('status') === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar
                    </option>
                    <option value="sudah_bayar" {{ request('status') === 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar
                    </option>
                </select>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Keterlambatan</th>
                            <th>Jumlah Denda</th>
                            <th>Status</th>
                            <th>Tgl Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dendas as $i => $d)
                            <tr>
                                <td>{{ $dendas->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $d->anggota->nama }}</td>
                                <td>{{ $d->pengembalian->peminjaman->buku->judul }}</td>
                                <td>{{ $d->hari_terlambat > 0 ? $d->hari_terlambat . ' hari' : '-' }}</td>
                                <td class="fw-semibold text-danger">
                                    Rp {{ number_format($d->jumlah_denda, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge {{ $d->status_bayar === 'sudah_bayar' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $d->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </td>
                                <td>{{ $d->tanggal_bayar ? $d->tanggal_bayar->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($d->status_bayar === 'belum_bayar')
                                        <form action="{{ route('denda.bayar', $d) }}" method="POST"
                                            onsubmit="return confirm('Konfirmasi pembayaran denda ini?')">
                                            @csrf
                                            <button class="btn btn-sm btn-success">
                                                <i class="bi bi-cash me-1"></i>Bayar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada data denda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $dendas->links() }}
        </div>
    </div>
@endsection