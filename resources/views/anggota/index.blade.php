@extends('layouts.app')
@section('title', 'Data Anggota')
@section('page-title', 'Data Anggota')

@section('breadcrumb')
    <li class="breadcrumb-item active">Anggota</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h6 class="mb-0 fw-semibold">Daftar Anggota</h6>

            <div class="d-flex gap-2">

                <!-- Tambah Anggota -->
                <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Anggota
                </a>

                <!-- Export -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('export.excel.anggota') }}">
                                <i class="bi bi-file-earmark-excel text-success me-2"></i>Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('export.pdf.anggota') }}">
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>Export PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group" style="max-width:360px">
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Cari nama, no anggota, email..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>No. Anggota</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas as $i => $a)
                            <tr>
                                <td>{{ $anggotas->firstItem() + $i }}</td>
                                <td><code>{{ $a->no_anggota }}</code></td>
                                <td class="fw-semibold">{{ $a->nama }}</td>
                                <td>{{ $a->email }}</td>
                                <td>{{ $a->no_hp ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $a->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($a->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('anggota.edit', $a) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('anggota.destroy', $a) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus anggota ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada anggota.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $anggotas->links() }}
        </div>
    </div>
@endsection