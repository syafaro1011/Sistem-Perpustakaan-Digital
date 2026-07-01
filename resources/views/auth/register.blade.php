<x-guest-layout>

    <div class="mb-4">
        <h5 style="font-size:1.05rem;font-weight:700;color:#0d2b26;margin-bottom:.2rem;">Buat Akun Baru</h5>
        <p style="font-size:.8rem;color:#94a3b8;font-weight:500;margin:0;">Daftarkan akun untuk mengakses sistem</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-person" style="color:#0f9b7a;"></i>
                </span>
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Nama lengkap" required autofocus autocomplete="name"
                    style="border-radius:0 8px 8px 0;">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-envelope" style="color:#0f9b7a;"></i>
                </span>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="email@contoh.com" required autocomplete="username"
                    style="border-radius:0 8px 8px 0;">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
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
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"
                    style="background:#f0faf7;border-color:#d1d5db;border-radius:8px 0 0 8px;">
                    <i class="bi bi-lock-fill" style="color:#0f9b7a;"></i>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Ulangi password" required autocomplete="new-password"
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

        {{-- Submit --}}
        <button type="submit" class="btn w-100 fw-bold mb-3"
            style="background:#0f9b7a;color:#fff;border:none;border-radius:9px;font-size:.9rem;padding:.6rem;">
            <i class="bi bi-person-plus me-1"></i>Daftar Sekarang
        </button>

        <div class="text-center" style="font-size:.82rem;color:#64748b;font-weight:500;">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color:#0f9b7a;font-weight:700;text-decoration:none;">
                Masuk di sini
            </a>
        </div>

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