@extends('layouts.app')
@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center p-4">
                @if($buku->cover)
                    <img src="{{ Storage::url($buku->cover) }}" alt="Cover" class="img-fluid rounded mb-3"
                        style="max-height:250px;object-fit:cover">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height:200px">
                        <i class="bi bi-book text-muted" style="font-size:4rem"></i>
                    </div>
                @endif
                <span class="badge {{ $buku->stok > 0 ? 'bg-success' : 'bg-danger' }} mb-2">
                    Stok: {{ $buku->stok }}
                </span>
                <a href="{{ route('buku.edit', $buku) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-1">{{ $buku->judul }}</h4>
                    <p class="text-muted mb-3">{{ $buku->penulis }}</p>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th width="130">Kode Buku</th>
                            <td><code>{{ $buku->kode_buku }}</code></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>{{ $buku->penerbit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>{{ $buku->tahun_terbit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>{{ $buku->isbn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>
                                @foreach($buku->kategoris as $k)
                                    <span class="badge bg-secondary">{{ $k->nama_kategori }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    @if($buku->sinopsis)
                        <hr>
                        <h6 class="fw-semibold">Sinopsis</h6>
                        <p class="text-muted">{{ $buku->sinopsis }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection