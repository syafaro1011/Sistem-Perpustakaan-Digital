@extends('layouts.app')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('kategori.index') }}" style="color:#0f9b7a;">Kategori</a>
    <span class="mx-1">/</span>Edit
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            {{-- ── Info Kategori saat ini ───────────────────────── --}}
            <div class="d-flex align-items-center gap-3 mb-3 px-1">
                <div
                    style="width:40px;height:40px;border-radius:10px;background:#f0fdf9;border:1px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-tag" style="color:#0f9b7a;font-size:1.1rem;"></i>
                </div>
                <div>
                    <div style="font-size:.82rem;color:#94a3b8;font-weight:500;">Mengedit kategori</div>
                    <div style="font-size:.95rem;font-weight:700;color:#0d2b26;">{{ $kategori->nama_kategori }}</div>
                </div>
                <span class="ms-auto badge fw-bold"
                    style="background:#f0fdf9;color:#0b7a60;font-size:.75rem;border-radius:20px;padding:.35rem .85rem;">
                    <i class="bi bi-journals me-1"
                        style="font-size:.7rem;"></i>{{ $kategori->bukus_count ?? $kategori->bukus()->count() }} buku
                </span>
            </div>

            {{-- ── Form Card ───────────────────────────────────── --}}
            <div class="card" style="border-color:#d1f5e8;">

                <div class="card-header bg-white py-3 px-4"
                    style="border-bottom:1px solid #d1f5e8;border-radius:12px 12px 0 0;">
                    <div style="font-size:.9rem;font-weight:700;color:#0d2b26;">
                        <i class="bi bi-pencil-square me-2" style="color:#0f9b7a;"></i>Edit Kategori
                    </div>
                    <div style="font-size:.74rem;color:#94a3b8;font-weight:500;margin-top:2px;">
                        Ubah informasi kategori buku
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"
                                placeholder="Deskripsi singkat tentang kategori ini (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn fw-bold px-4"
                                style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.55rem 1.1rem;">
                                <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
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