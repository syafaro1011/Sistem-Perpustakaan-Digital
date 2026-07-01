<x-guest-layout>

    {{-- Icon ilustrasi --}}
    <div class="text-center mb-4">
        <div
            style="width:64px;height:64px;border-radius:50%;background:#f0fdf9;border:2px solid #d1f5e8;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;">
            <i class="bi bi-envelope-check" style="font-size:1.8rem;color:#0f9b7a;"></i>
        </div>
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.25rem;">Verifikasi Email Kamu</h5>
        <p
            style="font-size:.8rem;color:#64748b;font-weight:500;margin:0;line-height:1.6;max-width:340px;display:inline-block;">
            Terima kasih sudah mendaftar! Klik tautan yang sudah kami kirimkan ke emailmu untuk mengaktifkan akun.
        </p>
    </div>

    {{-- Sukses kirim ulang --}}
    @if(session('status') === 'verification-link-sent')
        <div class="mb-3 px-3 py-2 rounded-3 d-flex align-items-start gap-2"
            style="background:#f0fdf9;border:1px solid #d1f5e8;font-size:.82rem;color:#0f9b7a;font-weight:500;">
            <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="font-size:.9rem;"></i>
            Tautan verifikasi baru telah dikirim ke alamat email yang kamu daftarkan.
        </div>
    @endif

    {{-- Info box --}}
    <div class="d-flex align-items-start gap-2 mb-4 px-3 py-2 rounded-3"
        style="background:#eff6ff;border:1px solid #bfdbfe;font-size:.79rem;color:#1d4ed8;">
        <i class="bi bi-info-circle-fill flex-shrink-0 mt-1" style="font-size:.85rem;"></i>
        <span style="font-weight:500;">Tidak menemukan email? Cek folder Spam atau Junk, atau klik tombol di bawah untuk
            kirim ulang.</span>
    </div>

    {{-- Actions --}}
    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
        @csrf
        <button type="submit" class="btn w-100 fw-bold"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.875rem;padding:.6rem;">
            <i class="bi bi-send me-1"></i>Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn w-100"
            style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:9px;font-size:.875rem;font-weight:600;padding:.55rem;">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
        </button>
    </form>

</x-guest-layout>