@extends('layouts.app')
@section('title', 'Tambah Peminjaman')
@section('page-title', 'Tambah Peminjaman')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm" style="max-width:650px">
        <div class="card-body p-4">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggotas as $a)
                                <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->no_anggota }} — {{ $a->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror">
                            <option value="">-- Pilih Buku --</option>
                            @foreach($bukus as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->judul }} (Stok: {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam"
                            class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                            value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
                        @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Batas Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali"
                            class="form-control @error('tanggal_kembali') is-invalid @enderror"
                            value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}">
                        @error('tanggal_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Simpan
                    </button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection