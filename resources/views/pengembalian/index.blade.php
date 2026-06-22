@extends('layouts.app')
@section('title', 'Data Pengembalian')
@section('page-title', 'Data Pengembalian')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pengembalian</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Pengembalian</h6>
            <a href="{{ route('pengembalian.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Catat Pengembalian
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tgl Kembali Aktual</th>
                            <th>Keterlambatan</th>
                            <th>Kondisi</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalians as $i => $p)
                            <tr>
                                <td>{{ $pengembalians->firstItem() + $i }}</td>
                                <td>{{ $p->peminjaman->anggota->nama }}</td>
                                <td>{{ $p->peminjaman->buku->judul }}</td>
                                <td>{{ $p->tanggal_kembali_aktual->format('d/m/Y') }}</td>
                                <td>
                                    @if($p->hari_terlambat > 0)
                                        <span class="badge bg-danger">{{ $p->hari_terlambat }} hari</span>
                                    @else
                                        <span class="badge bg-success">Tepat waktu</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $warna = ['baik' => 'success', 'rusak' => 'warning', 'hilang' => 'danger'];
                                    @endphp
                                    <span class="badge bg-{{ $warna[$p->kondisi_buku] }}">
                                        {{ ucfirst($p->kondisi_buku) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->denda)
                                        <span
                                            class="badge bg-{{ $p->denda->status_bayar === 'sudah_bayar' ? 'success' : 'danger' }}">
                                            Rp {{ number_format($p->denda->jumlah_denda) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data pengembalian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pengembalians->links() }}
        </div>
    </div>
@endsection