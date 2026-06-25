@extends('layouts.app')
@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Buku
@endsection

@section('content')

    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ──────────────────────────────────────────── --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
            style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">

            <div>
                <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Buku</div>
                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    Kelola koleksi buku perpustakaan
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('buku.create') }}" class="btn btn-sm fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.8rem;padding:.4rem .9rem;">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Buku
                </a>

                <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle fw-600"
                        style="background:#f0faf7;color:#0f9b7a;border:1px solid #d1f5e8;border-radius:8px;font-size:.8rem;font-weight:600;"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border shadow-sm mt-1"
                        style="border-color:#d1f5e8!important;min-width:170px;">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('export.excel.buku') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-excel me-2" style="color:#16a34a;"></i>Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('export.pdf.buku') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-pdf me-2" style="color:#dc2626;"></i>Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ── Search Bar ───────────────────────────────────────── --}}
        <div class="px-4 pt-3 pb-2">
            <form method="GET">
                <div class="input-group" style="max-width:360px;">
                    <span class="input-group-text"
                        style="background:#f0faf7;border-color:#d1f5e8;border-right:none;border-radius:8px 0 0 8px;">
                        <i class="bi bi-search" style="color:#0f9b7a;font-size:.85rem;"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, kode..."
                        value="{{ request('search') }}"
                        style="border-color:#d1f5e8;border-left:none;border-radius:0 8px 8px 0;font-size:.85rem;">
                </div>
            </form>
        </div>

        {{-- ── Table ────────────────────────────────────────────── --}}
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
                                Kode</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Judul Buku</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Penulis</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Kategori</th>
                            <th
                                style="width:70px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Stok</th>
                            <th
                                style="width:110px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $i => $buku)
                            <tr style="border-bottom:1px solid #f0faf7;">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $bukus->firstItem() + $i }}
                                </td>
                                <td>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:2px 7px;border-radius:5px;font-size:.78rem;font-weight:700;">
                                        {{ $buku->kode_buku }}
                                    </code>
                                </td>
                                <td>
                                    <div style="font-weight:600;font-size:.85rem;color:#0d2b26;">{{ $buku->judul }}</div>
                                    @if($buku->penerbit)
                                        <small style="color:#94a3b8;font-weight:500;">{{ $buku->penerbit }}</small>
                                    @endif
                                </td>
                                <td style="font-size:.84rem;font-weight:500;color:#374151;">{{ $buku->penulis }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($buku->kategoris as $k)
                                            <span class="badge"
                                                style="background:#f0fdf9;color:#0b7a60;font-size:.69rem;font-weight:700;border-radius:5px;">
                                                {{ $k->nama_kategori }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge fw-bold"
                                        style="{{ $buku->stok > 0 ? 'background:#f0fdf4;color:#166534;' : 'background:#fef2f2;color:#991b1b;' }}font-size:.75rem;border-radius:6px;padding:.3rem .6rem;">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('buku.show', $buku) }}" class="btn btn-sm"
                                            style="background:#eff6ff;color:#3b82f6;border:1px solid #bfdbfe;border-radius:6px;padding:.28rem .55rem;"
                                            title="Detail">
                                            <i class="bi bi-eye" style="font-size:.82rem;"></i>
                                        </a>
                                        <a href="{{ route('buku.edit', $buku) }}" class="btn btn-sm"
                                            style="background:#fefce8;color:#a16207;border:1px solid #fde68a;border-radius:6px;padding:.28rem .55rem;"
                                            title="Edit">
                                            <i class="bi bi-pencil" style="font-size:.82rem;"></i>
                                        </a>
                                        <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;padding:.28rem .55rem;"
                                                title="Hapus" data-confirm="Hapus buku &quot;{{ $buku->judul }}&quot;?">
                                                <i class="bi bi-trash" style="font-size:.82rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-journals d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data
                                        buku.</span><br>
                                    <a href="{{ route('buku.create') }}" class="btn btn-sm mt-2 fw-bold"
                                        style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                                        <i class="bi bi-plus-lg me-1"></i>Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($bukus->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $bukus->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection