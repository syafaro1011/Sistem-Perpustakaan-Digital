@extends('layouts.app')
@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('breadcrumb')
    <li class="breadcrumb-item active">Buku</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h6 class="mb-0 fw-semibold">Daftar Buku</h6>
            <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>Tambah Buku
            </a>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group" style="max-width:360px">
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Cari judul, penulis, kode..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th width="80">Stok</th>
                            <th width="130">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $i => $buku)
                            <tr>
                                <td>{{ $bukus->firstItem() + $i }}</td>
                                <td><code>{{ $buku->kode_buku }}</code></td>
                                <td>
                                    <div class="fw-semibold">{{ $buku->judul }}</div>
                                    <small class="text-muted">{{ $buku->penerbit ?? '' }}</small>
                                </td>
                                <td>{{ $buku->penulis }}</td>
                                <td>
                                    @foreach($buku->kategoris as $k)
                                        <span class="badge bg-secondary rounded-pill">{{ $k->nama_kategori }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('buku.show', $buku) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $bukus->links() }}
        </div>
    </div>
@endsection