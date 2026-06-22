@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row g-4">

        {{-- Kartu Info Peminjaman --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-arrow-left-right me-2 text-primary"></i>Info Peminjaman
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th width="150" class="text-muted fw-normal">Status</th>
                            <td>
                                @php
                                    $colors = [
                                        'dipinjam' => 'primary',
                                        'dikembalikan' => 'success',
                                        'terlambat' => 'danger',
                                    ];
                                    $terlambat = $peminjaman->status === 'dipinjam'
                                        && now()->gt($peminjaman->tanggal_kembali);
                                @endphp
                                <span class="badge bg-{{ $colors[$peminjaman->status] ?? 'secondary' }}">
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                                @if($terlambat)
                                    <span class="badge bg-warning text-dark ms-1">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Melewati batas!
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Tanggal Pinjam</th>
                            <td>{{ $peminjaman->tanggal_pinjam->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Batas Kembali</th>
                            <td>
                                {{ $peminjaman->tanggal_kembali->format('d F Y') }}
                                @if($terlambat)
                                    @php
                                        $selisih = now()->diffInDays($peminjaman->tanggal_kembali);
                                    @endphp
                                    <span class="text-danger small ms-1">({{ $selisih }} hari terlambat)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Dicatat oleh</th>
                            <td>{{ $peminjaman->user->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kartu Info Anggota --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-person me-2 text-success"></i>Info Anggota
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th width="150" class="text-muted fw-normal">No. Anggota</th>
                            <td><code>{{ $peminjaman->anggota->no_anggota }}</code></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Nama</th>
                            <td class="fw-semibold">{{ $peminjaman->anggota->nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Email</th>
                            <td>{{ $peminjaman->anggota->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">No. HP</th>
                            <td>{{ $peminjaman->anggota->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Status</th>
                            <td>
                                <span
                                    class="badge {{ $peminjaman->anggota->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($peminjaman->anggota->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kartu Info Buku --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-journals me-2 text-warning"></i>Info Buku
                    </h6>
                </div>
                <div class="card-body d-flex gap-3">
                    {{-- Cover buku --}}
                    @if($peminjaman->buku->cover)
                        <img src="{{ Storage::url($peminjaman->buku->cover) }}" alt="Cover" class="rounded border"
                            style="width:70px;height:90px;object-fit:cover;flex-shrink:0">
                    @else
                        <div class="rounded border bg-light d-flex align-items-center justify-content-center"
                            style="width:70px;height:90px;flex-shrink:0">
                            <i class="bi bi-book text-muted fs-4"></i>
                        </div>
                    @endif
                    <table class="table table-borderless table-sm mb-0 align-self-start">
                        <tr>
                            <th width="110" class="text-muted fw-normal">Kode Buku</th>
                            <td><code>{{ $peminjaman->buku->kode_buku }}</code></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Judul</th>
                            <td class="fw-semibold">{{ $peminjaman->buku->judul }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Penulis</th>
                            <td>{{ $peminjaman->buku->penulis }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Penerbit</th>
                            <td>{{ $peminjaman->buku->penerbit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Kategori</th>
                            <td>
                                @foreach($peminjaman->buku->kategoris as $k)
                                    <span class="badge bg-secondary rounded-pill">{{ $k->nama_kategori }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kartu Info Pengembalian & Denda --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold">
                        <i class="bi bi-arrow-return-left me-2 text-info"></i>Info Pengembalian & Denda
                    </h6>
                </div>
                <div class="card-body">
                    @if($peminjaman->pengembalian)
                        @php $kembali = $peminjaman->pengembalian; @endphp
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th width="160" class="text-muted fw-normal">Tgl Kembali Aktual</th>
                                <td>{{ $kembali->tanggal_kembali_aktual->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Keterlambatan</th>
                                <td>
                                    @if($kembali->hari_terlambat > 0)
                                        <span class="badge bg-danger">{{ $kembali->hari_terlambat }} hari</span>
                                    @else
                                        <span class="badge bg-success">Tepat waktu</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted fw-normal">Kondisi Buku</th>
                                <td>
                                    @php
                                        $warna = ['baik' => 'success', 'rusak' => 'warning', 'hilang' => 'danger'];
                                    @endphp
                                    <span class="badge bg-{{ $warna[$kembali->kondisi_buku] }}">
                                        {{ ucfirst($kembali->kondisi_buku) }}
                                    </span>
                                </td>
                            </tr>
                            @if($kembali->catatan)
                                <tr>
                                    <th class="text-muted fw-normal">Catatan</th>
                                    <td class="text-muted small">{{ $kembali->catatan }}</td>
                                </tr>
                            @endif

                            @if($kembali->denda)
                                <tr>
                                    <td colspan="2">
                                        <hr class="my-2">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-normal">Jumlah Denda</th>
                                    <td class="fw-bold text-danger">
                                        Rp {{ number_format($kembali->denda->jumlah_denda, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-normal">Status Denda</th>
                                    <td>
                                        <span
                                            class="badge {{ $kembali->denda->status_bayar === 'sudah_bayar' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $kembali->denda->status_bayar === 'sudah_bayar' ? 'Lunas' : 'Belum Bayar' }}
                                        </span>
                                    </td>
                                </tr>
                                @if($kembali->denda->tanggal_bayar)
                                    <tr>
                                        <th class="text-muted fw-normal">Tgl Bayar</th>
                                        <td>{{ $kembali->denda->tanggal_bayar->format('d F Y') }}</td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td colspan="2">
                                        <span class="badge bg-success">Tidak ada denda</span>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    @else
                        {{-- Belum dikembalikan --}}
                        <div class="text-center py-3">
                            <i class="bi bi-hourglass-split text-warning" style="font-size:2.5rem"></i>
                            <p class="text-muted mt-2 mb-3">Buku belum dikembalikan.</p>
                            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}"
                                class="btn btn-success btn-sm">
                                <i class="bi bi-arrow-return-left me-1"></i>Catat Pengembalian
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        @if($peminjaman->status === 'dipinjam')
            <a href="{{ route('pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}" class="btn btn-success">
                <i class="bi bi-arrow-return-left me-1"></i>Catat Pengembalian
            </a>
        @endif
    </div>
@endsection