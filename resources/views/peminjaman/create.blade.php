@extends('layouts.app')
@section('title', 'Tambah Peminjaman')
@section('page-title', 'Tambah Peminjaman')

@section('breadcrumb-trail')
    <span class="mx-1">/</span><a href="{{ route('peminjaman.index') }}" style="color:#0f9b7a;">Peminjaman</a>
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
    /* Info preview box */
    .preview-box {
        background   : #fff;
        border       : 1px solid #d1f5e8;
        border-radius: 8px;
        padding      : .75rem 1rem;
        font-size    : .82rem;
        color        : #374151;
        font-weight  : 500;
        display      : none;
        margin-top   : .5rem;
    }
    .preview-box.show { display: block; }
    .preview-box .pk { color:#94a3b8;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.4px; }
    .preview-box .pv { color:#0d2b26;font-weight:600;font-size:.85rem;margin-top:1px; }
    /* Duration pill */
    .dur-pill {
        display      : inline-flex;
        align-items  : center;
        gap          : .35rem;
        padding      : .3rem .8rem;
        border-radius: 20px;
        border       : 1.5px solid #d1f5e8;
        background   : #fff;
        cursor       : pointer;
        font-size    : .8rem;
        font-weight  : 600;
        color        : #374151;
        transition   : all .15s;
        user-select  : none;
    }
    .dur-pill input { display:none; }
    .dur-pill:has(input:checked) {
        background  : #f0fdf9;
        border-color: #0f9b7a;
        color       : #0f9b7a;
    }
</style>
@endpush

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">

        <form action="{{ route('peminjaman.store') }}" method="POST" id="form-pinjam">
        @csrf

        {{-- ── Pilih Anggota ────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-person-badge"></i> Pilih Anggota
            </div>
            <select name="anggota_id" id="sel-anggota"
                    class="form-select @error('anggota_id') is-invalid @enderror"
                    onchange="showAnggotaPreview(this)">
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggotas as $a)
                <option value="{{ $a->id }}"
                        data-no="{{ $a->no_anggota }}"
                        data-nama="{{ $a->nama }}"
                        data-email="{{ $a->email }}"
                        {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                    {{ $a->no_anggota }} — {{ $a->nama }}
                </option>
                @endforeach
            </select>
            @error('anggota_id')<div class="invalid-feedback">{{ $message }}</div>@enderror

            {{-- Preview anggota --}}
            <div class="preview-box {{ old('anggota_id') ? 'show' : '' }}" id="preview-anggota">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:38px;height:38px;border-radius:50%;background:#f0fdf9;border:1.5px solid #d1f5e8;display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:700;color:#0f9b7a;flex-shrink:0;"
                         id="pa-avatar">—</div>
                    <div>
                        <div class="pk">No. Anggota</div>
                        <div class="pv" id="pa-no">—</div>
                    </div>
                    <div class="ms-2">
                        <div class="pk">Nama</div>
                        <div class="pv" id="pa-nama">—</div>
                    </div>
                    <div class="ms-auto">
                        <div class="pk">Email</div>
                        <div class="pv" id="pa-email" style="font-size:.78rem;">—</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Pilih Buku ───────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-journals"></i> Pilih Buku
            </div>
            <select name="buku_id" id="sel-buku"
                    class="form-select @error('buku_id') is-invalid @enderror"
                    onchange="showBukuPreview(this)">
                <option value="">-- Pilih Buku --</option>
                @foreach($bukus as $b)
                <option value="{{ $b->id }}"
                        data-kode="{{ $b->kode_buku }}"
                        data-judul="{{ $b->judul }}"
                        data-penulis="{{ $b->penulis }}"
                        data-stok="{{ $b->stok }}"
                        {{ old('buku_id') == $b->id ? 'selected' : '' }}
                        {{ $b->stok === 0 ? 'disabled' : '' }}>
                    {{ $b->judul }} — Stok: {{ $b->stok }}{{ $b->stok === 0 ? ' (Habis)' : '' }}
                </option>
                @endforeach
            </select>
            @error('buku_id')<div class="invalid-feedback">{{ $message }}</div>@enderror

            {{-- Preview buku --}}
            <div class="preview-box {{ old('buku_id') ? 'show' : '' }}" id="preview-buku">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:38px;height:38px;border-radius:8px;background:#f0fdf9;border:1px solid #d1f5e8;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-book" style="color:#0f9b7a;"></i>
                    </div>
                    <div>
                        <div class="pk">Kode Buku</div>
                        <code style="background:#f0fdf9;color:#0b7a60;padding:1px 6px;border-radius:4px;font-size:.78rem;font-weight:700;" id="pb-kode">—</code>
                    </div>
                    <div class="ms-2">
                        <div class="pk">Judul</div>
                        <div class="pv" id="pb-judul">—</div>
                    </div>
                    <div class="ms-auto text-end">
                        <div class="pk">Stok</div>
                        <span id="pb-stok" class="badge fw-bold" style="font-size:.75rem;">—</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Tanggal ───────────────────────────────────────── --}}
        <div class="form-section">
            <div class="form-section-title">
                <i class="bi bi-calendar-range"></i> Tanggal Peminjaman
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_pinjam" id="tgl-pinjam"
                           class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                           value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                           onchange="updateReturnDate()">
                    @error('tanggal_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Batas Kembali <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_kembali" id="tgl-kembali"
                           class="form-control @error('tanggal_kembali') is-invalid @enderror"
                           value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}">
                    @error('tanggal_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Shortcut durasi --}}
            <div class="mt-3">
                <div style="font-size:.75rem;font-weight:600;color:#64748b;margin-bottom:.5rem;">Durasi cepat:</div>
                <div class="d-flex gap-2 flex-wrap">
                    <label class="dur-pill">
                        <input type="radio" name="_dur" value="7" onchange="setDuration(7)">
                        7 hari
                    </label>
                    <label class="dur-pill">
                        <input type="radio" name="_dur" value="14" onchange="setDuration(14)" checked>
                        14 hari
                    </label>
                    <label class="dur-pill">
                        <input type="radio" name="_dur" value="21" onchange="setDuration(21)">
                        21 hari
                    </label>
                    <label class="dur-pill">
                        <input type="radio" name="_dur" value="30" onchange="setDuration(30)">
                        30 hari
                    </label>
                </div>
            </div>
        </div>

        {{-- ── Actions ──────────────────────────────────────── --}}
        <div class="d-flex gap-2">
            <button type="submit"
                    class="btn fw-bold"
                    style="background:#0f9b7a;color:#fff;border:none;border-radius:8px;font-size:.875rem;padding:.55rem 1.4rem;">
                <i class="bi bi-check-lg me-1"></i>Simpan Peminjaman
            </button>
            <a href="{{ route('peminjaman.index') }}"
               class="btn"
               style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:.875rem;font-weight:600;padding:.55rem 1rem;">
                Batal
            </a>
        </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ── Anggota preview ───────────────────────────────────
    function showAnggotaPreview(sel) {
        const opt = sel.options[sel.selectedIndex];
        const box = document.getElementById('preview-anggota');
        if (!sel.value) { box.classList.remove('show'); return; }
        document.getElementById('pa-avatar').textContent  = opt.dataset.nama?.charAt(0).toUpperCase() || '?';
        document.getElementById('pa-no').textContent      = opt.dataset.no    || '—';
        document.getElementById('pa-nama').textContent    = opt.dataset.nama  || '—';
        document.getElementById('pa-email').textContent   = opt.dataset.email || '—';
        box.classList.add('show');
    }

    // ── Buku preview ──────────────────────────────────────
    function showBukuPreview(sel) {
        const opt  = sel.options[sel.selectedIndex];
        const box  = document.getElementById('preview-buku');
        if (!sel.value) { box.classList.remove('show'); return; }
        const stok = parseInt(opt.dataset.stok);
        document.getElementById('pb-kode').textContent  = opt.dataset.kode   || '—';
        document.getElementById('pb-judul').textContent = opt.dataset.judul  || '—';
        const stokEl = document.getElementById('pb-stok');
        stokEl.textContent = stok + ' unit';
        stokEl.style.cssText = stok > 0
            ? 'background:#f0fdf4;color:#166534;'
            : 'background:#fef2f2;color:#991b1b;';
        box.classList.add('show');
    }

    // ── Durasi cepat ──────────────────────────────────────
    function setDuration(days) {
        const pinjam  = document.getElementById('tgl-pinjam').value;
        if (!pinjam) return;
        const dt = new Date(pinjam);
        dt.setDate(dt.getDate() + parseInt(days));
        document.getElementById('tgl-kembali').value = dt.toISOString().split('T')[0];
    }

    function updateReturnDate() {
        const checked = document.querySelector('[name="_dur"]:checked');
        if (checked) setDuration(checked.value);
    }

    // Init on load for old() values
    document.addEventListener('DOMContentLoaded', () => {
        const sa = document.getElementById('sel-anggota');
        const sb = document.getElementById('sel-buku');
        if (sa?.value) showAnggotaPreview(sa);
        if (sb?.value) showBukuPreview(sb);
    });
</script>
@endpush