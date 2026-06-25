@extends('layouts.app')
@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('breadcrumb-trail')
    <span class="mx-1">/</span>Anggota
@endsection

@section('content')

    <div class="card" style="border-color:#d1f5e8;">

        {{-- ── Header ─────────────────────────────────────────── --}}
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4"
            style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
            <div>
                <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">Daftar Anggota</div>
                <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:1px;">
                    Kelola data anggota perpustakaan
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('anggota.create') }}" class="btn btn-sm fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.8rem;padding:.4rem .9rem;">
                    <i class="bi bi-person-plus me-1"></i>Tambah Anggota
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
                            <a class="dropdown-item py-2" href="{{ route('export.excel.anggota') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-excel me-2" style="color:#16a34a;"></i>Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('export.pdf.anggota') }}"
                                style="font-size:.83rem;font-weight:500;">
                                <i class="bi bi-file-earmark-pdf me-2" style="color:#dc2626;"></i>Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- ── Search + Filter ────────────────────────────────── --}}
        <div class="px-4 pt-3 pb-2">
            <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
                <div class="input-group" style="max-width:360px;">
                    <span class="input-group-text"
                        style="background:#f0faf7;border-color:#d1f5e8;border-right:none;border-radius:8px 0 0 8px;">
                        <i class="bi bi-search" style="color:#0f9b7a;font-size:.85rem;"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, no. anggota, email..."
                        value="{{ request('search') }}"
                        style="border-color:#d1f5e8;border-left:none;border-radius:0 8px 8px 0;font-size:.85rem;">
                </div>
                {{-- Filter status --}}
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()"
                    style="max-width:140px;border-color:#d1f5e8;border-radius:8px;font-size:.83rem;font-weight:600;color:#374151;">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
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
                                No. Anggota</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                Nama & Email</th>
                            <th
                                style="font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                                No. HP</th>
                            <th
                                style="width:100px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;text-align:center;">
                                Status</th>
                            <th
                                style="width:90px;font-size:.71rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#94a3b8;border-bottom:2px solid #d1f5e8;">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas as $i => $a)
                            <tr style="border-bottom:1px solid #f0faf7;">
                                <td style="font-size:.82rem;color:#94a3b8;font-weight:600;">
                                    {{ $anggotas->firstItem() + $i }}
                                </td>
                                <td>
                                    <code
                                        style="background:#f0fdf9;color:#0b7a60;padding:2px 8px;border-radius:5px;font-size:.78rem;font-weight:700;">
                                                {{ $a->no_anggota }}
                                            </code>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        {{-- Avatar inisial --}}
                                        <div
                                            style="width:34px;height:34px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.78rem;font-weight:700;color:#0f9b7a;">
                                            {{ strtoupper(substr($a->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:700;font-size:.875rem;color:#0d2b26;">{{ $a->nama }}</div>
                                            <div style="font-size:.76rem;color:#94a3b8;font-weight:500;">{{ $a->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:.84rem;font-weight:500;color:#374151;">
                                    {{ $a->no_hp ?? '-' }}
                                </td>
                                <td class="text-center">
                                    @if($a->status === 'aktif')
                                        <span class="badge fw-bold"
                                            style="background:#f0fdf4;color:#166534;font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                            <i class="bi bi-circle-fill me-1" style="font-size:.45rem;vertical-align:2px;"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge fw-bold"
                                            style="background:#f1f5f9;color:#475569;font-size:.73rem;border-radius:20px;padding:.3rem .75rem;">
                                            <i class="bi bi-circle me-1" style="font-size:.45rem;vertical-align:2px;"></i>Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('anggota.edit', $a) }}" class="btn btn-sm"
                                            style="background:#fefce8;color:#a16207;border:1px solid #fde68a;border-radius:6px;padding:.28rem .55rem;"
                                            title="Edit">
                                            <i class="bi bi-pencil" style="font-size:.82rem;"></i>
                                        </a>
                                        <form action="{{ route('anggota.destroy', $a) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;padding:.28rem .55rem;"
                                                title="Hapus" data-confirm="Hapus anggota &quot;{{ $a->nama }}&quot;?">
                                                <i class="bi bi-trash" style="font-size:.82rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-people d-block mb-2" style="font-size:2.2rem;color:#d1f5e8;"></i>
                                    <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">Belum ada data
                                        anggota.</span><br>
                                    <a href="{{ route('anggota.create') }}" class="btn btn-sm mt-2 fw-bold"
                                        style="background:#0f9b7a;color:#fff;border:none;border-radius:7px;font-size:.78rem;">
                                        <i class="bi bi-person-plus me-1"></i>Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($anggotas->hasPages())
                <div class="mt-3 d-flex justify-content-end">
                    {{ $anggotas->links() }}
                </div>
            @endif
        </div>

    </div>

@endsection