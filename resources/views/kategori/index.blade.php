@extends('layouts.app')
@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('breadcrumb')
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Kategori</h6>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            {{-- Search --}}
            <form method="GET" class="mb-3">
                <div class="input-group" style="max-width:320px">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kategori..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="100">Jumlah Buku</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $i => $k)
                            <tr>
                                <td>{{ $kategoris->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                                <td class="text-muted small">{{ $k->deskripsi ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">{{ $k->bukus_count }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('kategori.edit', $k) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $kategoris->links() }}
        </div>
    </div>
@endsection