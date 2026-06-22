@extends('layouts.app')
@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Kode Buku <span class="text-danger">*</span></label>
                        <input type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror"
                            value="{{ old('kode_buku', $buku->kode_buku) }}">
                        @error('kode_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $buku->judul) }}">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                            value="{{ old('penulis', $buku->penulis) }}">
                        @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control"
                            value="{{ old('penerbit', $buku->penerbit) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control"
                            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok', $buku->stok) }}" min="0">
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Kategori</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($kategoris as $k)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="kategori_ids[]" value="{{ $k->id }}"
                                        id="kat{{ $k->id }}" {{ in_array($k->id, old('kategori_ids', $selectedKategori)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kat{{ $k->id }}">
                                        {{ $k->nama_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Sinopsis</label>
                        <textarea name="sinopsis" class="form-control"
                            rows="4">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cover Buku</label>
                        @if($buku->cover)
                            <div class="mb-2">
                                <img src="{{ Storage::url($buku->cover) }}" alt="Cover" height="80" class="rounded border">
                            </div>
                        @endif
                        <input type="file" name="cover" class="form-control" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover.</small>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>Update
                    </button>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection