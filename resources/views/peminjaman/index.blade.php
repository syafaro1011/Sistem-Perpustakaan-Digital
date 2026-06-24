@extends('layouts.app')
@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')

@section('breadcrumb')
    <li class="breadcrumb-item active">Peminjaman</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Peminjaman</h6>

            <!-- Export -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('export.excel.peminjaman') }}">
                            <i class="bi bi-file-earmark-excel text-success me-2"></i>Export Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('export.pdf.peminjaman') }}">
                            <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export PDF
                        </a>
                    </li>
                </ul>
            </div>

            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Tambah Peminjaman
            </a>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-3 d-flex gap-2 flex-wrap">
                <div class="input-group" style="max-width:300px">
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Cari anggota / buku..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
                </div>
                <select name="status" class="form-select form-select-sm" style="max-width:160px"
                    onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan
                    </option>
                    <option value="terlambat" {{ request('status') === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $i => $p)
                            @php
                                $terlambat = $p->status === 'dipinjam' && now()->gt($p->tanggal_kembali);
                            @endphp
                            <tr class="{{ $terlambat ? 'table-warning' : '' }}">
                                <td>{{ $peminjamans->firstItem() + $i }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $p->anggota->nama }}</div>
                                    <small class="text-muted">{{ $p->anggota->no_anggota }}</small>
                                </td>
                                <td>{{ $p->buku->judul }}</td>
                                <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>
                                    {{ $p->tanggal_kembali->format('d/m/Y') }}
                                    @if($terlambat)
                                        <span class="badge bg-danger ms-1">Terlambat!</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $colors = ['dipinjam' => 'primary', 'dikembalikan' => 'success', 'terlambat' => 'danger'];
                                    @endphp
                                    <span class="badge bg-{{ $colors[$p->status] ?? 'secondary' }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($p->status === 'dipinjam')
                                        <a href="{{ route('pengembalian.create', ['peminjaman_id' => $p->id]) }}"
                                            class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-arrow-return-left"></i>
                                        </a>
                                    @endif
                                    <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $peminjamans->links() }}
        </div>
    </div>
@endsection