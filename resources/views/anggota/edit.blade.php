@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('anggota.index') }}" style="color:#0f9b7a;">Anggota</a>
    <span class="mx-1">/</span>Edit
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
        font-size     : .76rem;
        font-weight   : 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color         : #0f9b7a;
        margin-bottom : .75rem;
        display       : flex;
        align-items   : center;
        gap           : .4rem;
    }
    .status-toggle { display: none; }
    .status-label {
        display      : flex;
        align-items  : center;
        gap          : .5rem;
        padding      : .45rem 1rem;
        border-radius: 20px;
        border       : 1.5px solid #d1f5e8;
        background   : #fff;
        cursor       : pointer;
        font-size    : .83rem;
        font-weight  : 600;
        color        : #475569;
        transition   : all .15s;
        user-select  : none;
    }
    .status-toggle:checked + .status-label {
        background  : #f0fdf9;
        border-color: #0f9b7a;
        color       : #0f9b7a;
    }
    .status-dot {
        width : 8px; height: 8px;
        border-radius: 50%;
        background: #cbd5e1;
        flex-shrink: 0;
        transition: background .15s;
    }
    .status-toggle:checked + .status-label .status-dot { background: #0f9b7a; }
</style>
@endpush

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        {{-- ── Info Bar anggota yang sedang diedit ─────────── --}}
        <div class="d-flex align-items-center gap-3 mb-3 px-1">
            <div style="width:42px;height:42px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.9rem;font-weight:700;color:#0f9b7a;">
                {{ strtoupper(substr($anggota->nama, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:.8rem;color:#94a3b8;font-weight:500;">Mengedit anggota</div>
                <div style="font-size:.95rem;font-weight:700;color:#0d2b26;">{{ $anggota->nama }}</div>
            </div>
            <div class="ms-auto">
                <code style="background:#f0fdf9;color:#0b7a60;padding:3px 10px;border-radius:6px;font-size:.8rem;font-weight:700;">
                    {{ $anggota->no_anggota }}
                </code>
            </div>
        </div>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf @method('PUT')

        {{-- ── Data Diri ────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-person-badge"></i> Data Diri Anggota
            </div>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">No. Anggota <span class="text-danger">*</span></label>
                    <input type="text" name="no_anggota"
                           class="form-control @error('no_anggota') is-invalid @enderror"
                           value="{{ old('no_anggota', $anggota->no_anggota) }}">
                    @error('no_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-7">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $anggota->nama) }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-7">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"
                              style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                            <i class="bi bi-envelope" style="color:#0f9b7a;"></i>
                        </span>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $anggota->email) }}"
                               style="border-radius:0 8px 8px 0;">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label">No. HP</label>
                    <div class="input-group">
                        <span class="input-group-text"
                              style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                            <i class="bi bi-telephone" style="color:#0f9b7a;"></i>
                        </span>
                        <input type="text" name="no_hp" class="form-control"
                               value="{{ old('no_hp', $anggota->no_hp) }}"
                               placeholder="08xxxxxxxxxx"
                               style="border-radius:0 8px 8px 0;">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $anggota->alamat) }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── Status ───────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-toggle-on"></i> Status Keanggotaan
            </div>
            <div class="d-flex gap-2">
                <input type="radio" name="status" id="st_aktif" value="aktif" class="status-toggle"
                       {{ old('status', $anggota->status) === 'aktif' ? 'checked' : '' }}>
                <label for="st_aktif" class="status-label">
                    <span class="status-dot"></span>Aktif
                </label>

                <input type="radio" name="status" id="st_nonaktif" value="nonaktif" class="status-toggle"
                       {{ old('status', $anggota->status) === 'nonaktif' ? 'checked' : '' }}>
                <label for="st_nonaktif" class="status-label">
                    <span class="status-dot"></span>Non-Aktif
                </label>
            </div>
        </div>

        {{-- ── Actions ──────────────────────────────────────── --}}
        <div class="d-flex gap-2">
            <button type="submit"
                    class="btn fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.55rem 1.4rem;">
                <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
            </button>
            <a href="{{ route('anggota.index') }}"
               class="btn fw-600"
               style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.875rem;font-weight:600;padding:.55rem 1rem;">
                Batal
            </a>
        </div>

        </form>
    </div>
</div>

@endsection