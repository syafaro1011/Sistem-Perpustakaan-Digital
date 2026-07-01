<x-guest-layout>

    <div class="mb-4">
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.2rem;">Atur Ulang Password</h5>
        <p style="font-size:.8rem;color:#94a3b8;font-weight:500;margin:0;">Masukkan password baru untuk akunmu</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-envelope" style="color:#0f9b7a;"></i>
                </span>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                    style="border-radius:0 8px 8px 0;">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- New Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-lock" style="color:#0f9b7a;"></i>
                </span>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 karakter" required
                    autocomplete="new-password" style="border-color:#d1d5db;border-right:none;border-radius:0;">
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

        {{-- Confirm Password --}}
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-lock-fill" style="color:#0f9b7a;"></i>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Ulangi password baru" required autocomplete="new-password"
                    style="border-color:#d1d5db;border-right:none;border-radius:0;">
                <button type="button" class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-left:none;border-radius:0 8px 8px 0;cursor:pointer;"
                    onclick="togglePass('password_confirmation', this)">
                    <i class="bi bi-eye" style="color:#94a3b8;font-size:.85rem;"></i>
                </button>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn w-100 fw-bold"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.9rem;padding:.6rem;">
            <i class="bi bi-shield-check me-1"></i>Reset Password
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