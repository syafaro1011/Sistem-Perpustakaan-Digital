<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap 5 & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ─── Design Tokens ─────────────────────────────── */
        :root {
            --sb-bg-deep: #0d2b26;
            --sb-bg-mid: #133028;
            --sb-accent: #0f9b7a;
            --sb-accent-hover: #0b8269;
            --sb-text-muted: rgba(255, 255, 255, .40);
            --sb-width: 240px;
            --sb-collapsed-width: 60px;
            --tb-height: 54px;
            --page-bg: #f0faf7;
            --card-border: #d1f5e8;
            --accent: #0f9b7a;
            --accent-light: #f0fdf9;
            --sb-transition: .25s cubic-bezier(.4, 0, .2, 1);
        }

        /* ─── Base ──────────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            background: var(--page-bg);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            font-size: 1rem;
            color: #1e293b;
        }

        /* ─── Sidebar ───────────────────────────────────── */
        .sidebar {
            width: var(--sb-width);
            min-height: 100vh;
            background: var(--sb-bg-deep);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 300;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width var(--sb-transition), transform var(--sb-transition);
        }

        /* ── Collapsed state ── */
        .sidebar.collapsed {
            width: var(--sb-collapsed-width);
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px 14px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
            padding: 15px 0 14px;
        }

        .sidebar-brand-icon {
            width: 36px;
            height: 36px;
            background: var(--sb-accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-brand-icon i {
            font-size: 1.15rem;
            color: #e0fff6;
        }

        .sidebar-brand-title {
            font-size: .95rem;
            font-weight: 700;
            color: #f0fdf9;
            line-height: 1.2;
            transition: opacity var(--sb-transition), width var(--sb-transition);
        }

        .sidebar-brand-sub {
            font-size: .76rem;
            font-weight: 400;
            color: var(--sb-text-muted);
            margin-top: 1px;
        }

        /* Hide brand text when collapsed */
        .sidebar.collapsed .sidebar-brand-title,
        .sidebar.collapsed .sidebar-brand-sub {
            display: none;
        }

        /* Nav section label */
        .nav-section-title {
            display: block;
            color: rgba(255, 255, 255, .28);
            font-size: .73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.1px;
            padding: 14px 14px 4px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--sb-transition);
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            padding: 0;
            pointer-events: none;
        }

        /* Nav link */
        .sidebar .nav-link {
            color: rgba(255, 255, 255, .52);
            padding: 7px 10px;
            border-radius: 8px;
            margin: 1px 8px;
            font-size: .9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 9px;
            transition: background .15s, color .15s, padding .25s, margin .25s;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
        }

        .sidebar .nav-link i {
            font-size: 1rem;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .08);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--sb-accent);
        }

        /* Collapsed nav links — icon only, centered */
        .sidebar.collapsed .nav-link {
            justify-content: center;
            align-items: center;
            padding: 9px 0;
            margin: 1px 6px;
            gap: 0;
            width: calc(var(--sb-collapsed-width) - 12px);
        }

        .sidebar.collapsed .nav-link i {
            margin: 0 auto;
        }

        .sidebar.collapsed .nav-link .nav-link-text {
            display: none;
        }

        /* Badge adjust when collapsed */
        .sidebar.collapsed .nav-link .badge {
            position: absolute;
            top: 4px;
            right: 4px;
            font-size: .55rem;
            padding: .15em .35em;
        }

        /* Tooltip on collapsed hover */
        .sidebar.collapsed .nav-link {
            overflow: visible;
        }

        .sidebar.collapsed .nav-link::after {
            content: attr(data-label);
            position: absolute;
            left: calc(var(--sb-collapsed-width) - 4px);
            top: 50%;
            transform: translateY(-50%);
            background: #0d2b26;
            color: #f0fdf9;
            font-size: .75rem;
            font-weight: 600;
            padding: .3rem .65rem;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity .15s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .25);
            z-index: 400;
        }

        .sidebar.collapsed .nav-link:hover::after {
            opacity: 1;
        }

        /* Sidebar footer (user info) */
        .sidebar-footer {
            padding: 10px 12px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
            overflow: hidden;
            transition: padding var(--sb-transition);
        }

        .sidebar.collapsed .sidebar-footer {
            justify-content: center;
            padding: 10px 0;
        }

        .sidebar.collapsed .sidebar-footer-info,
        .sidebar.collapsed .sidebar-footer-logout {
            display: none;
        }

        .sidebar-avatar {
            width: 32px;
            height: 32px;
            background: var(--sb-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            color: #f0fdf9;
            font-size: .85rem;
            font-weight: 600;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sidebar-user-role {
            color: var(--sb-text-muted);
            font-size: .76rem;
        }

        /* ─── Topbar ────────────────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sb-width);
            right: 0;
            height: var(--tb-height);
            background: #fff;
            border-bottom: 1px solid var(--card-border);
            z-index: 200;
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            justify-content: space-between;
            transition: left var(--sb-transition);
        }

        body.sb-collapsed .topbar {
            left: var(--sb-collapsed-width);
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0d2b26;
            line-height: 1.2;
        }

        .topbar-breadcrumb {
            font-size: .78rem;
            font-weight: 500;
            color: #94a3b8;
            margin-top: 1px;
        }

        .topbar-breadcrumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .topbar-breadcrumb a:hover {
            text-decoration: underline;
        }

        .topbar-notif-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--accent-light);
            border: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
        }

        .topbar-notif-btn i {
            color: var(--accent);
            font-size: 1rem;
        }

        .topbar-user-btn {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 10px;
            border-radius: 8px;
            background: #f8fffe;
            border: 1px solid var(--card-border);
            cursor: pointer;
            transition: background .15s;
        }

        .topbar-user-btn:hover {
            background: var(--accent-light);
        }

        .topbar-user-avatar {
            width: 27px;
            height: 27px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
        }

        /* ─── Main Content ──────────────────────────────── */
        .main-content {
            margin-left: var(--sb-width);
            margin-top: var(--tb-height);
            padding: 1.25rem;
            min-height: calc(100vh - var(--tb-height));
            transition: margin-left var(--sb-transition);
        }

        body.sb-collapsed .main-content {
            margin-left: var(--sb-collapsed-width);
        }

        /* ─── Breadcrumb ────────────────────────────────── */
        .breadcrumb {
            font-size: .8rem;
            font-weight: 500;
            margin-bottom: .75rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #94a3b8;
        }

        .breadcrumb-item a {
            color: var(--accent);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #64748b;
        }

        /* ─── Cards ─────────────────────────────────────── */
        .card {
            border-radius: 12px;
            border: 1px solid var(--card-border);
            background: #fff;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            border-bottom: 1px solid var(--card-border);
            background: #fff;
            font-weight: 600;
            font-size: .95rem;
            color: #0d2b26;
        }

        /* ─── Tables ────────────────────────────────────── */
        .table thead th {
            font-size: .8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #64748b;
            border-bottom: 2px solid var(--card-border);
            background: #fafffe;
        }

        .table td {
            vertical-align: middle;
            color: #374151;
            font-weight: 500;
            font-size: .94rem;
        }

        /* ─── Buttons ───────────────────────────────────── */
        .btn {
            border-radius: 8px;
            font-size: .925rem;
            font-weight: 600;
        }

        .btn-sm {
            padding: .3rem .75rem;
            font-size: .855rem;
            border-radius: 6px;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: var(--sb-accent-hover);
            border-color: var(--sb-accent-hover);
        }

        .btn-outline-primary {
            color: var(--accent);
            border-color: var(--accent);
        }

        .btn-outline-primary:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ─── Badge ─────────────────────────────────────── */
        .badge {
            border-radius: 6px;
            font-weight: 700;
            font-size: .78rem;
            letter-spacing: .2px;
        }

        /* ─── Forms ─────────────────────────────────────── */
        .form-control,
        .form-select {
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: .95rem;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(15, 155, 122, .12);
        }

        .form-label {
            font-weight: 600;
            font-size: .9rem;
            color: #374151;
        }

        /* ─── Pagination ────────────────────────────────── */
        .pagination {
            gap: 3px;
        }

        .page-link {
            border-radius: 7px !important;
            border: 1px solid var(--card-border);
            color: #374151;
            font-size: .88rem;
            font-weight: 600;
            padding: .35rem .72rem;
        }

        .page-link:hover {
            background: var(--accent-light);
            color: var(--accent);
        }

        .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ─── Alert ─────────────────────────────────────── */
        .alert {
            border-radius: 10px;
            font-size: .94rem;
            font-weight: 500;
        }

        /* ─── Sidebar Collapse Toggle Button ────────────── */
        #sidebarCollapseBtn {
            border-radius: 7px;
            transition: background .15s;
        }

        #sidebarCollapseBtn:hover {
            background: var(--accent-light);
        }

        #collapseIcon {
            display: inline-block;
            transition: transform var(--sb-transition);
        }

        /* ─── Mobile Overlay ────────────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 299;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Mobile Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    {{-- ── SIDEBAR ─────────────────────────────────────── --}}
    <nav class="sidebar" id="sidebar">

        {{-- Brand --}}
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div>
                <div class="sidebar-brand-title">Perpustakaan</div>
                <div class="sidebar-brand-sub">Digital Library System</div>
            </div>
        </a>

        {{-- Nav --}}
        <ul class="nav flex-column py-2 flex-grow-1">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}" data-label="Dashboard"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i><span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <span class="nav-section-title">Koleksi Buku</span>

            <li class="nav-item">
                <a href="{{ route('buku.index') }}" data-label="Data Buku"
                    class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                    <i class="bi bi-journals"></i><span class="nav-link-text">Data Buku</span>
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" data-label="Kategori Buku"
                        class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i><span class="nav-link-text">Kategori Buku</span>
                    </a>
                </li>
            @endif

            <span class="nav-section-title">Sirkulasi</span>

            <li class="nav-item">
                <a href="{{ route('anggota.index') }}" data-label="Anggota"
                    class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i><span class="nav-link-text">Anggota</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('peminjaman.index') }}" data-label="Peminjaman"
                    class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i><span class="nav-link-text">Peminjaman</span>
                    @php
                        $aktif = \App\Models\Peminjaman::where('status', 'dipinjam')
                            ->where('tanggal_kembali', '<', now())->count();
                    @endphp
                    @if($aktif > 0)
                        <span class="badge bg-danger ms-auto">{{ $aktif }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pengembalian.index') }}" data-label="Pengembalian"
                    class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-return-left"></i><span class="nav-link-text">Pengembalian</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('denda.index') }}" data-label="Denda"
                    class="nav-link {{ request()->routeIs('denda.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i><span class="nav-link-text">Denda</span>
                    @php
                        $belumBayar = \App\Models\Denda::where('status_bayar', 'belum_bayar')->count();
                    @endphp
                    @if($belumBayar > 0)
                        <span class="badge bg-warning text-dark ms-auto">{{ $belumBayar }}</span>
                    @endif
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <span class="nav-section-title">Admin</span>

                <li class="nav-item">
                    <a href="{{ route('activity-log.index') }}" data-label="Activity Log"
                        class="nav-link {{ request()->routeIs('activity-log.*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i><span class="nav-link-text">Activity Log</span>
                    </a>
                </li>
            @endif

        </ul>

        {{-- User Footer --}}
        <div class="sidebar-footer">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-footer-info" style="min-width:0;">
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ms-auto sidebar-footer-logout">
                @csrf
                <button type="submit" class="btn btn-sm border-0 p-1" style="color:rgba(255,255,255,.35);"
                    title="Logout">
                    <i class="bi bi-box-arrow-right fs-6"></i>
                </button>
            </form>
        </div>

    </nav>

    {{-- ── TOPBAR ──────────────────────────────────────── --}}
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            {{-- Desktop collapse toggle --}}
            <button class="btn btn-sm border-0 d-none d-md-flex p-1 align-items-center justify-content-center"
                id="sidebarCollapseBtn" onclick="toggleCollapse()" style="color:#0d2b26; width:30px; height:30px;"
                aria-label="Toggle sidebar">
                <i class="bi bi-chevron-left fs-6" id="collapseIcon"></i>
            </button>

            {{-- Mobile toggle --}}
            <button class="btn btn-sm border-0 d-md-none p-1" onclick="toggleSidebar()" style="color:#0d2b26;"
                aria-label="Toggle menu">
                <i class="bi bi-list fs-5"></i>
            </button>

            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <nav class="topbar-breadcrumb" aria-label="breadcrumb">
                    <a href="{{ route('dashboard') }}">Home</a>
                    @yield('breadcrumb-trail')
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="text-muted d-none d-md-block" style="font-size:.78rem;font-weight:500;">
                {{ now()->translatedFormat('d M Y') }}
            </span>
            <div class="vr d-none d-md-block" style="height:20px;"></div>

            {{-- Notification button --}}
            <div class="topbar-notif-btn" title="Notifikasi">
                <i class="bi bi-bell"></i>
            </div>

            {{-- User dropdown --}}
            <div class="dropdown">
                <div class="topbar-user-btn" data-bs-toggle="dropdown" role="button">
                    <div class="topbar-user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="d-none d-md-block" style="font-size:.8rem;font-weight:600;color:#0d2b26;">
                        {{ auth()->user()->name }}
                    </span>
                    <i class="bi bi-chevron-down d-none d-md-block" style="font-size:.7rem;color:#94a3b8;"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border shadow-sm mt-1"
                    style="min-width:210px;border-color:var(--card-border)!important;">
                    <li class="px-3 py-2 border-bottom" style="border-color:var(--card-border)!important;">
                        <div style="font-weight:700;font-size:.82rem;color:#0d2b26;">{{ auth()->user()->name }}</div>
                        <div style="font-size:.73rem;color:#94a3b8;">{{ auth()->user()->email }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider" style="border-color:var(--card-border);">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger"
                                style="font-size:.83rem;font-weight:600;">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- ── MAIN CONTENT ────────────────────────────────── --}}
    <main class="main-content">
        <x-alert />
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ── Sidebar Mobile Toggle ──────────────────── */
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }

        /* ── Sidebar Desktop Collapse ───────────────── */
        function toggleCollapse() {
            const sidebar = document.getElementById('sidebar');
            const body = document.body;
            const icon = document.getElementById('collapseIcon');
            const isCollapsed = sidebar.classList.toggle('collapsed');
            body.classList.toggle('sb-collapsed', isCollapsed);

            // Ganti arah panah
            icon.className = isCollapsed ? 'bi bi-chevron-right fs-6' : 'bi bi-chevron-left fs-6';

            // Simpan state ke localStorage
            localStorage.setItem('sidebarCollapsed', isCollapsed ? '1' : '0');
        }

        // Restore state saat halaman load
        (function () {
            if (localStorage.getItem('sidebarCollapsed') === '1') {
                document.getElementById('sidebar').classList.add('collapsed');
                document.body.classList.add('sb-collapsed');
                const icon = document.getElementById('collapseIcon');
                if (icon) icon.className = 'bi bi-chevron-right fs-6';
            }
        })();

        /* ── Auto-dismiss alert (4 detik) ─────────── */
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                bootstrap.Alert.getOrCreateInstance(el)?.close();
            });
        }, 4000);

        /* ── Konfirmasi hapus global ─────────────── */
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-confirm]').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    if (!confirm(this.dataset.confirm)) e.preventDefault();
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>