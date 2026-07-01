<x-guest-layout>

    {{-- ── Card Title ───────────────────────────────────── --}}
    <div class="mb-4">
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.2rem;">Masuk ke Akun</h5>
        <p style="font-size:.8rem;color:#94a3b8;font-weight:500;margin:0;">Selamat datang kembali di Perpustakaan
            Digital</p>
    </div>

    {{-- ── Session Status ───────────────────────────────── --}}
    @if(session('status'))
        <div class="mb-3 px-3 py-2 rounded-3"
            style="background:#f0fdf9;border:1px solid #d1f5e8;font-size:.82rem;color:#0f9b7a;font-weight:500;">
            <i class="bi bi-check-circle me-1"></i>{{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-envelope" style="color:#0f9b7a;"></i>
                </span>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus autocomplete="username"
                    style="border-radius:0 8px 8px 0;">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label mb-0">Password</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        style="font-size:.78rem;color:#0f9b7a;font-weight:600;text-decoration:none;">
                        Lupa password?
                    </a>
                @endif
            </div>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-lock" style="color:#0f9b7a;"></i>
                </span>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required
                    autocomplete="current-password" style="border-color:#d1d5db;border-right:none;border-radius:0;">
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

        {{-- Remember me --}}
        <div class="mb-4 d-flex align-items-center gap-2">
            <input type="checkbox" name="remember" id="remember_me" class="form-check-input"
                style="width:16px;height:16px;border-radius:4px;margin:0;flex-shrink:0;">
            <label for="remember_me" style="font-size:.83rem;font-weight:500;color:#374151;cursor:pointer;">
                Ingat saya
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn w-100 fw-bold mb-3"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.9rem;padding:.6rem;">
            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
        </button>

    </form>

    {{-- ── Demo Accounts ────────────────────────────────── --}}
    <div class="px-3 py-2 rounded-3" style="background:#f8fffe;border:1px solid #d1f5e8;font-size:.78rem;">
        <div style="font-weight:700;color:#0d2b26;margin-bottom:.4rem;">
            <i class="bi bi-info-circle me-1" style="color:#0f9b7a;"></i>Akun Demo
        </div>
        <div style="color:#374151;font-weight:500;margin-bottom:.2rem;">
            <i class="bi bi-person-badge me-1" style="color:#0f9b7a;font-size:.8rem;"></i>
            <strong>Admin:</strong> admin@perpustakaan.com / password
        </div>
        <div style="color:#374151;font-weight:500;">
            <i class="bi bi-person me-1" style="color:#64748b;font-size:.8rem;"></i>
            <strong>Petugas:</strong> petugas@perpustakaan.com / password
        </div>
    </div>

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