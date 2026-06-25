@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('kategori.index') }}" style="color:#0f9b7a;">Kategori</a>
    <span class="mx-1">/</span>Tambah
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            {{-- ── Form Card ───────────────────────────────────── --}}
            <div class="card" style="border-color:#d1f5e8;">

                <div class="card-header bg-white py-3 px-4"
                    style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
                    <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">
                        <i class="bi bi-plus-circle me-2" style="color:#0f9b7a;"></i>Tambah Kategori Baru
                    </div>
                    <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:2px;">
                        Isi informasi kategori buku di bawah ini
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori') }}" placeholder="Contoh: Novel, Sains, Teknologi...">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"
                                placeholder="Deskripsi singkat tentang kategori ini (opsional)">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn fw-bold px-4"
                                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.55rem 1.1rem;">
                                <i class="bi bi-check-lg me-1"></i>Simpan
                            </button>
                            <a href="{{ route('kategori.index') }}" class="btn fw-600"
                                style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.875rem;font-weight:600;padding:.55rem 1rem;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection