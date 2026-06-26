@extends('layouts.app')
@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Buku
@endsection

@push('styles')
    <style>
        .buku-card {
            border: 1px solid #d1f5e8;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .18s, box-shadow .18s;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .buku-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(15, 155, 122, .10);
        }

        .buku-cover {
            width: 100%;
            height: 175px;
            object-fit: cover;
            background: #f0faf7;
            display: block;
        }

        .buku-cover-placeholder {
            width: 100%;
            height: 175px;
            background: linear-gradient(135deg, #f0fdf9 0%, #e6f7f3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #d1f5e8;
        }

        .buku-body {
            padding: .85rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .buku-judul {
            font-weight: 700;
            font-size: .875rem;
            color: #0d2b26;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 3px;
        }

        .buku-penulis {
            font-size: .77rem;
            color: #64748b;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: .55rem;
        }

        .buku-footer {
            padding: .6rem 1rem;
            border-top: 1px solid #f0faf7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .4rem;
            background: #fafffe;
        }

        /* View toggle */
        .view-btn {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            border: 1px solid #d1f5e8;
            background: #fff;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .15s;
            font-size: .9rem;
        }

        .view-btn.active,
        .view-btn:hover {
            background: #f0fdf9;
            color: #0f9b7a;
            border-color: #0f9b7a;
        }

        /* Action buttons */
        .act-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            text-decoration: none;
            transition: opacity .15s;
            cursor: pointer;
        }

        .act-btn:hover {
            opacity: .82;
        }

        .act-btn-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .act-btn-yellow {
            background: #fefce8;
            color: #a16207;
        }

        .act-btn-red {
            background: #fef2f2;
            color: #dc2626;
        }
    </style>
@endpush

@section('content')

    {{-- ── Outer Card ───────────────────────────────────────────────── --}}
    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ──────────────────────────────────────────────── --}}
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
                    <button class="btn btn-sm dropdown-toggle"
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

        {{-- ── Toolbar: Search + View Toggle ──────────────────────── --}}
        <div class="px-4 pt-3 pb-2 d-flex align-items-center justify-content-between flex-wrap gap-2">
            <form method="GET" class="flex-grow-1">
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

            {{-- Toggle grid / list --}}
            <div class="d-flex gap-1">
                <button class="view-btn active" id="btnGrid" onclick="setView('grid')" title="Grid">
                    <i class="bi bi-grid-3x3-gap"></i>
                </button>
                <button class="view-btn" id="btnList" onclick="setView('list')" title="List">
                    <i class="bi bi-list-ul"></i>
                </button>
            </div>
        </div>

        {{-- ── GRID VIEW ────────────────────────────────────────────── --}}
        <div id="viewGrid" class="px-4 pb-3">
            @forelse($bukus as $i => $buku)

                {{-- Baris baru setiap 4 card --}}
                @if($i % 4 === 0)
                        @if($i !== 0)
                        </div> @endif
                    <div class="row g-3 mb-0 mt-{{ $i === 0 ? '1' : '0' }}">
                @endif

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="buku-card shadow-sm">

                        {{-- Cover --}}
                        @if($buku->cover)
                            <img src="{{ Storage::url($buku->cover) }}" alt="{{ $buku->judul }}" class="buku-cover">
                        @else
                            <div class="buku-cover-placeholder">
                                <i class="bi bi-book" style="font-size:2.8rem;color:#a7f3d0;"></i>
                            </div>
                        @endif

                        {{-- Body --}}
                        <div class="buku-body">
                            {{-- Kode --}}
                            <div class="mb-1">
                                <code style="background:#f0fdf9;color:#0b7a60;padding:1px 6px;
                                                 border-radius:4px;font-size:.69rem;font-weight:700;">
                                        {{ $buku->kode_buku }}
                                    </code>
                            </div>
                            <div class="buku-judul">{{ $buku->judul }}</div>
                            <div class="buku-penulis">{{ $buku->penulis }}</div>

                            {{-- Kategori --}}
                            <div class="d-flex flex-wrap gap-1 mt-auto">
                                @forelse($buku->kategoris->take(2) as $k)
                                    <span style="background:#f0fdf9;color:#0b7a60;border:1px solid #d1f5e8;
                                                         padding:1px 7px;border-radius:20px;font-size:.68rem;font-weight:700;">
                                        {{ $k->nama_kategori }}
                                    </span>
                                @empty
                                    <span style="font-size:.72rem;color:#cbd5e1;">Tanpa kategori</span>
                                @endforelse
                                @if($buku->kategoris->count() > 2)
                                    <span style="background:#f1f5f9;color:#94a3b8;padding:1px 7px;
                                                         border-radius:20px;font-size:.68rem;font-weight:700;">
                                        +{{ $buku->kategoris->count() - 2 }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="buku-footer">
                            {{-- Stok --}}
                            <span class="badge fw-bold" style="{{ $buku->stok > 0
                ? 'background:#f0fdf4;color:#166534;'
                : 'background:#fef2f2;color:#991b1b;' }}
                                             font-size:.72rem;border-radius:6px;padding:.28rem .65rem;">
                                <i class="bi bi-layers me-1"></i>{{ $buku->stok }} stok
                            </span>

                            {{-- Actions --}}
                            <div class="d-flex gap-1">
                                <a href="{{ route('buku.show', $buku) }}" class="act-btn act-btn-blue" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('buku.edit', $buku) }}" class="act-btn act-btn-yellow" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="act-btn act-btn-red" title="Hapus"
                                        data-confirm="Hapus buku &quot;{{ $buku->judul }}&quot;?">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if($loop->last)
                </div> @endif

            @empty
            <div class="text-center py-5">
                <i class="bi bi-journals d-block mb-2" style="font-size:2.5rem;color:#d1f5e8;"></i>
                <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data buku.</span><br>
                <a href="{{ route('buku.create') }}" class="btn btn-sm mt-2 fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Sekarang
                </a>
            </div>
        @endforelse
    </div>

    {{-- ── LIST VIEW (fallback tabel) ─────────────────────────── --}}
    <div id="viewList" class="px-4 pb-3" style="display:none;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background:#fafffe;">
                        @foreach(['#', 'Kode', 'Judul Buku', 'Penulis', 'Kategori', 'Stok', ''] as $th)
                            <th style="font-size:.71rem;font-weight:700;text-transform:uppercase;
                                           letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                {{ $th }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $i => $buku)
                                <tr style="border-bottom:1px solid #f0faf7;">
                                    <td style="font-size:.82rem;color:#94a3b8;font-weight:600;width:46px;">
                                        {{ $bukus->firstItem() + $i }}
                                    </td>
                                    <td>
                                        <code style="background:#f0fdf9;color:#0b7a60;padding:2px 7px;
                                                         border-radius:5px;font-size:.78rem;font-weight:700;">
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
                                                <span class="badge" style="background:#f0fdf9;color:#0b7a60;font-size:.69rem;
                                                                     font-weight:700;border-radius:5px;">
                                                    {{ $k->nama_kategori }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge fw-bold" style="{{ $buku->stok > 0
                        ? 'background:#f0fdf4;color:#166534;'
                        : 'background:#fef2f2;color:#991b1b;' }}
                                                         font-size:.75rem;border-radius:6px;padding:.3rem .6rem;">
                                            {{ $buku->stok }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('buku.show', $buku) }}" class="act-btn act-btn-blue" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('buku.edit', $buku) }}" class="act-btn act-btn-yellow" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="act-btn act-btn-red" title="Hapus"
                                                    data-confirm="Hapus buku &quot;{{ $buku->judul }}&quot;?">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-journals d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">
                                    Belum ada data buku.
                                </span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Pagination ───────────────────────────────────────────── --}}
    @if($bukus->hasPages())
        <div class="px-4 pb-3 d-flex justify-content-end">
            {{ $bukus->links() }}
        </div>
    @endif

    </div>

@endsection

@push('scripts')
    <script>
        // ── View toggle: grid / list ───────────────────────────────
        function setView(v) {
            const isGrid = v === 'grid';
            document.getElementById('viewGrid').style.display = isGrid ? '' : 'none';
            document.getElementById('viewList').style.display = isGrid ? 'none' : '';
            document.getElementById('btnGrid').classList.toggle('active', isGrid);
            document.getElementById('btnList').classList.toggle('active', !isGrid);
            localStorage.setItem('bukuView', v);
        }

        // Restore view preference dari localStorage
        document.addEventListener('DOMContentLoaded', function () {
            const saved = localStorage.getItem('bukuView') || 'grid';
            setView(saved);
        });
    </script>
@endpush