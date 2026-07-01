<x-guest-layout>

    <div class="mb-4">
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.2rem;">Lupa Password?</h5>
        <p style="font-size:.8rem;color:#64748b;font-weight:500;margin:0;line-height:1.5;">
            Masukkan email kamu dan kami akan mengirimkan tautan untuk mengatur ulang password.
        </p>
    </div>

    {{-- Session Status --}}
    @if(session('status'))
        <div class="mb-3 px-3 py-2 rounded-3 d-flex align-items-start gap-2"
            style="background:#f0fdf9;border:1px solid #d1f5e8;font-size:.82rem;color:#0f9b7a;font-weight:500;">
            <i class="bi bi-check-circle-fill flex-shrink-0 mt-1" style="font-size:.9rem;"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-envelope" style="color:#0f9b7a;"></i>
                </span>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus
                    style="border-radius:0 8px 8px 0;">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn w-100 fw-bold mb-3"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.9rem;padding:.6rem;">
            <i class="bi bi-send me-1"></i>Kirim Tautan Reset Password
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}" style="font-size:.82rem;color:#0f9b7a;font-weight:600;text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke halaman login
            </a>
        </div>

    </form>

</x-guest-layout>