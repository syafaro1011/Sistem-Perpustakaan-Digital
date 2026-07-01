<x-guest-layout>

    <div class="mb-4">
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.2rem;">Konfirmasi Password</h5>
        <p style="font-size:.8rem;color:#64748b;font-weight:500;margin:0;line-height:1.5;">
            Ini adalah area aman. Konfirmasi password-mu sebelum melanjutkan.
        </p>
    </div>

    {{-- Security notice --}}
    <div class="d-flex align-items-start gap-2 mb-4 px-3 py-2 rounded-3"
        style="background:#eff6ff;border:1px solid #bfdbfe;font-size:.8rem;color:#1d4ed8;">
        <i class="bi bi-shield-lock-fill flex-shrink-0 mt-1" style="font-size:.9rem;"></i>
        <span style="font-weight:500;">Sesi kamu membutuhkan verifikasi ulang sebelum mengakses halaman ini.</span>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-lock" style="color:#0f9b7a;"></i>
                </span>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password kamu"
                    required autocomplete="current-password"
                    style="border-color:#d1d5db;border-right:none;border-radius:0;">
                <button type="button" class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-left:none;border-radius:0 8px 8px 0;cursor:pointer;"
                    onclick="togglePass('password', this)">
                    <i class="bi bi-eye" style="color:#94a3b8;font-size:.85rem;"></i>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn w-100 fw-bold"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.9rem;padding:.6rem;">
            <i class="bi bi-shield-check me-1"></i>Konfirmasi
        </button>

    </form>

    <script>
        function togglePass(id, btn) {
            const inp = document.getElementById(id);
            const ico = btn.querySelector('i');
            if (inp.type === 'password') {
                inp.type = 'text';
                ico.className = 'bi bi-eye-slash';
                ico.style.color = '#0f9b7a';
            } else {
                inp.type = 'password';
                ico.className = 'bi bi-eye';
                ico.style.color = '#94a3b8';
            }
        }
    </script>

</x-guest-layout>