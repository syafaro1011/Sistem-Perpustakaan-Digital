@extends('layouts.app')
@section('title', 'Catat Pengembalian')
@section('page-title', 'Catat Pengembalian')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pengembalian.index') }}">Pengembalian</a></li>
    <li class="breadcrumb-item active">Catat</li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm" style="max-width:650px">
        <div class="card-body p-4">
            <form action="{{ route('pengembalian.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Data Peminjaman <span class="text-danger">*</span></label>
                        <select name="peminjaman_id" class="form-select @error('peminjaman_id') is-invalid @enderror">
                            <option value="">-- Pilih Peminjaman --</option>
                            @foreach($peminjamans as $p)
                                <option value="{{ $p->id }}" {{ (old('peminjaman_id', $peminjaman?->id) == $p->id) ? 'selected' : '' }}>
                                    {{ $p->anggota->nama }} — {{ $p->buku->judul }}
                                    (Batas: {{ $p->tanggal_kembali->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('peminjaman_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Kembali Aktual <span
                                class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kembali_aktual"
                            class="form-control @error('tanggal_kembali_aktual') is-invalid @enderror"
                            value="{{ old('tanggal_kembali_aktual', date('Y-m-d')) }}">
                        @error('tanggal_kembali_aktual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kondisi Buku <span class="text-danger">*</span></label>
                        <select name="kondisi_buku" class="form-select @error('kondisi_buku') is-invalid @enderror">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak (+Rp 50.000)</option>
                            <option value="hilang">Hilang (+Rp 200.000)</option>
                        </select>
                        @error('kondisi_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="2"
                            placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-info py-2 mb-0 small">
                            <i class="bi bi-info-circle me-1"></i>
                            Denda keterlambatan: <strong>Rp 2.000/hari</strong>.
                            Denda akan dibuat otomatis jika ada keterlambatan atau kerusakan.
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg me-1"></i>Simpan Pengembalian
                    </button>
                    <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection