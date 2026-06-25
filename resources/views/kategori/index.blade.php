@extends('layouts.app')
@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Kategori
@endsection

@section('content')

    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
            style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
            <div>
                <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Kategori</div>
                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    Kelola kategori koleksi buku
                </div>
            </div>
            <a href="{{ route('kategori.create') }}" class="btn btn-sm fw-bold"
                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.8rem;padding:.4rem .9rem;">
                <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
            </a>
        </div>

        {{-- ── Search ──────────────────────────────────────────── --}}
        <div class="px-4 pt-3 pb-2">
            <form method="GET">
                <div class="input-group" style="max-width:320px;">
                    <span class="input-group-text"
                        style="background:#f0faf7;border-color:#d1f5e8;border-right:none;border-radius:8px 0 0 8px;">
                        <i class="bi bi-search" style="color:#0f9b7a;font-size:.85rem;"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                        value="{{ request('search') }}"
                        style="border-color:#d1f5e8;border-left:none;border-radius:0 8px 8px 0;font-size:.85rem;">
                </div>
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
                                Nama Kategori</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Deskripsi</th>
                            <th
                                style="width:130px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Jumlah Buku</th>
                            <th
                                style="width:90px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $i => $k)
                            <tr style="border-bottom:1px solid #f0faf7;">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $kategoris->firstItem() + $i }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            style="width:32px;height:32px;border-radius:8px;background:#f0fdf9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="bi bi-tag" style="color:#0f9b7a;font-size:.85rem;"></i>
                                        </div>
                                        <span style="font-weight:700;font-size:.875rem;color:#0d2b26;">
                                            {{ $k->nama_kategori }}
                                        </span>
                                    </div>
                                </td>
                                <td style="font-size:.84rem;color:#64748b;font-weight:500;max-width:300px;">
                                    {{ Str::limit($k->deskripsi, 60) ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <span class="badge fw-bold"
                                        style="background:#f0fdf9;color:#0b7a60;font-size:.75rem;border-radius:20px;padding:.3rem .75rem;">
                                        <i class="bi bi-journals me-1" style="font-size:.7rem;"></i>{{ $k->bukus_count }} buku
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('kategori.edit', $k) }}" class="btn btn-sm"
                                            style="background:#fefce8;color:#a16207;border:1px solid #fde68a;border-radius:6px;padding:.28rem .55rem;"
                                            title="Edit">
                                            <i class="bi bi-pencil" style="font-size:.82rem;"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;padding:.28rem .55rem;"
                                                title="Hapus"
                                                data-confirm="Hapus kategori &quot;{{ $k->nama_kategori }}&quot;?">
                                                <i class="bi bi-trash" style="font-size:.82rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-tags d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada kategori.</span><br>
                                    <a href="{{ route('kategori.create') }}" class="btn btn-sm mt-2 fw-bold"
                                        style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                                        <i class="bi bi-plus-lg me-1"></i>Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($kategoris->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $kategoris->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection