@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('buku.index') }}" style="color:#0f9b7a;">Buku</a>
    <span class="mx-1">/</span>Tambah
@endsection

@push('styles')
<style>
    .form-section {
        background   : #f8fffe;
        border       : 1px solid #d1f5e8;
        border-radius: 10px;
        padding      : 1.1rem 1.2rem;
        margin-bottom: 1rem;
    }
    .form-section-title {
        font-size    : .76rem;
        font-weight  : 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color        : #0f9b7a;
        margin-bottom : .75rem;
        display      : flex;
        align-items  : center;
        gap          : .4rem;
    }
    .kat-pill {
        display     : flex;
        align-items : center;
        gap         : .4rem;
        padding     : .35rem .75rem;
        border-radius: 20px;
        border      : 1.5px solid #d1f5e8;
        background  : #fff;
        cursor      : pointer;
        font-size   : .8rem;
        font-weight : 600;
        color       : #374151;
        transition  : all .15s;
        user-select : none;
    }
    .kat-pill:has(input:checked) {
        background  : #f0fdf9;
        border-color: #0f9b7a;
        color       : #0f9b7a;
    }
    .kat-pill input { display: none; }
    .cover-drop {
        border       : 2px dashed #d1f5e8;
        border-radius: 10px;
        padding      : 1.5rem;
        text-align   : center;
        cursor       : pointer;
        transition   : border-color .15s, background .15s;
        background   : #f8fffe;
    }
    .cover-drop:hover { border-color: #0f9b7a; background: #f0fdf9; }
    .cover-drop input[type=file] { display: none; }
    #cover-preview { display: none; max-height: 120px; border-radius: 8px; margin-top: .75rem; object-fit: cover; }
</style>
@endpush

@section('content')

<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row g-3">

    {{-- ── Kiri: Form Utama ──────────────────────────────── --}}
    <div class="col-lg-8">

        {{-- Identitas Buku --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-bookmark"></i> Identitas Buku
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" name="kode_buku"
                           class="form-control @error('kode_buku') is-invalid @enderror"
                           value="{{ old('kode_buku') }}"
                           placeholder="BK-0001">
                    @error('kode_buku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}"
                           placeholder="Masukkan judul lengkap buku">
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="penulis"
                           class="form-control @error('penulis') is-invalid @enderror"
                           value="{{ old('penulis') }}"
                           placeholder="Nama penulis">
                    @error('penulis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control"
                           value="{{ old('penerbit') }}" placeholder="Nama penerbit">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control"
                           value="{{ old('tahun_terbit') }}"
                           min="1900" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', 0) }}" min="0">
                    @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control"
                           value="{{ old('isbn') }}" placeholder="978-xxx-xxx-xxx-x">
                </div>
            </div>
        </div>

        {{-- Sinopsis --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-text-paragraph"></i> Sinopsis
            </div>
            <textarea name="sinopsis" class="form-control" rows="4"
                      placeholder="Tulis sinopsis atau deskripsi singkat buku...">{{ old('sinopsis') }}</textarea>
        </div>

        {{-- Kategori --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-tags"></i> Kategori Buku
            </div>
            <div class="d-flex flex-wrap gap-2">
                @foreach($kategoris as $k)
                <label class="kat-pill">
                    <input type="checkbox" name="kategori_ids[]" value="{{ $k->id }}"
                           {{ in_array($k->id, old('kategori_ids', [])) ? 'checked' : '' }}>
                    <i class="bi bi-check2 d-none check-icon" style="font-size:.8rem;"></i>
                    {{ $k->nama_kategori }}
                </label>
                @endforeach
            </div>
        </div>

    </div>

    {{-- ── Kanan: Cover & Aksi ───────────────────────────── --}}
    <div class="col-lg-4">

        {{-- Cover Upload --}}
        <div class="card mb-3" style="border-color:#d1f5e8;">
            <div class="card-body">
                <div class="form-section-title" style="margin-bottom:.6rem;">
                    <i class="bi bi-image"></i> Cover Buku
                </div>
                <label class="cover-drop w-100" for="cover-input">
                    <input type="file" id="cover-input" name="cover" accept="image/*"
                           onchange="previewCover(this)">
                    <i class="bi bi-cloud-upload" style="font-size:2rem;color:#d1f5e8;"></i>
                    <div style="font-size:.8rem;color:#94a3b8;font-weight:500;margin-top:.4rem;">
                        Klik untuk upload cover
                    </div>
                    <div style="font-size:.72rem;color:#d1d5db;margin-top:2px;">PNG, JPG, JPEG maks 2MB</div>
                    <img id="cover-preview" src="" alt="Preview">
                </label>
                @error('cover')<div class="text-danger mt-1" style="font-size:.78rem;">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="card" style="border-color:#d1f5e8;">
            <div class="card-body d-flex flex-column gap-2">
                <button type="submit"
                        class="btn fw-bold"
                        style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.55rem;">
                    <i class="bi bi-check-lg me-1"></i>Simpan Buku
                </button>
                <a href="{{ route('buku.index') }}"
                   class="btn fw-600"
                   style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.875rem;font-weight:600;padding:.55rem;text-align:center;">
                    Batal
                </a>
            </div>
        </div>

    </div>
</div>

</form>

@endsection

@push('scripts')
<script>
    function previewCover(input) {
        const preview = document.getElementById('cover-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush