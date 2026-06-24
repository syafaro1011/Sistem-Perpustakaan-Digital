<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg-from : #1a2f4e;
            --sidebar-bg-to   : #243e63;
            --sidebar-width   : 248px;
            --topbar-height   : 56px;
            --accent          : #4f6ef7;
        }

        * { box-sizing: border-box; }

        body {
            background: #f0f4f8;
            font-family: 'Segoe UI', system-ui, sans-serif;
            font-size: .92rem;
        }

        /* ── Sidebar ─────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg,
                var(--sidebar-bg-from) 0%,
                var(--sidebar-bg-to) 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform .25s ease;
        }

        .sidebar-brand {
            padding: 1.1rem 1.3rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            display: block;
        }

        .sidebar-brand h5 {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .sidebar-brand small { color: rgba(255,255,255,.45); font-size:.72rem; }

        .nav-section-title {
            color: rgba(255,255,255,.35);
            font-size: .67rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: .85rem 1.2rem .3rem;
            display: block;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.68);
            padding: .52rem 1.1rem;
            border-radius: 8px;
            margin: 1px 8px;
            font-size: .845rem;
            display: flex;
            align-items: center;
            gap: .55rem;
            transition: all .18s;
        }

        .sidebar .nav-link i { font-size: 1rem; flex-shrink: 0; }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,.10);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--accent);
            box-shadow: 0 2px 8px rgba(79,110,247,.35);
        }

        .sidebar-footer {
            padding: .85rem 1rem;
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: auto;
        }

        .user-info-name {
            color: #fff;
            font-size: .82rem;
            font-weight: 600;
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ── Topbar ──────────────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            z-index: 100;
            display: flex;
            align-items: center;
            padding: 0 1.4rem;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
        }

        /* ── Main Content ────────────────────────────── */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 1.4rem;
            min-height: calc(100vh - var(--topbar-height));
        }

        /* ── Cards ───────────────────────────────────── */
        .card {
            border-radius: 12px;
            border: 1px solid #e8edf3;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            border-bottom: 1px solid #e8edf3;
        }

        /* ── Tables ──────────────────────────────────── */
        .table thead th {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }

        .table td { vertical-align: middle; color: #374151; }

        /* ── Buttons ─────────────────────────────────── */
        .btn { border-radius: 8px; font-size: .845rem; }
        .btn-sm { padding: .3rem .7rem; font-size: .78rem; border-radius: 6px; }

        /* ── Badge ───────────────────────────────────── */
        .badge { border-radius: 6px; font-weight: 600; letter-spacing: .2px; }

        /* ── Forms ───────────────────────────────────── */
        .form-control, .form-select {
            border-radius: 8px;
            border-color: #d1d5db;
            font-size: .875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(79,110,247,.12);
        }

        /* ── Pagination ──────────────────────────────── */
        .pagination { gap: 3px; }
        .page-link {
            border-radius: 7px !important;
            border: 1px solid #e2e8f0;
            color: #374151;
            font-size: .82rem;
            padding: .35rem .7rem;
        }
        .page-link:hover { background: #f0f4f8; }
        .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ── Alert ───────────────────────────────────── */
        .alert { border-radius: 10px; }

        /* ── Mobile Overlay ──────────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 199;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .topbar, .main-content { left: 0; margin-left: 0; }
            .topbar { left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ── Mobile Overlay ─────────────────────────────── --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- ── SIDEBAR ─────────────────────────────────────── --}}
<nav class="sidebar" id="sidebar">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <h5><i class="bi bi-book-half me-2"></i>Perpustakaan</h5>
        <small>Digital Library System</small>
    </a>

    {{-- Nav --}}
    <ul class="nav flex-column py-2 flex-grow-1">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
        </li>

        <span class="nav-section-title">Koleksi Buku</span>

        <li class="nav-item">
            <a href="{{ route('buku.index') }}"
               class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <i class="bi bi-journals"></i>Data Buku
            </a>
        </li>

        @if(auth()->user()->role === 'admin')
        <li class="nav-item">
            <a href="{{ route('kategori.index') }}"
               class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>Kategori Buku
            </a>
        </li>
        @endif

        <span class="nav-section-title">Sirkulasi</span>

        <li class="nav-item">
            <a href="{{ route('anggota.index') }}"
               class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>Anggota
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peminjaman.index') }}"
               class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i>Peminjaman
                @php $aktif = \App\Models\Peminjaman::where('status','dipinjam')
                                ->where('tanggal_kembali','<',now())->count(); @endphp
                @if($aktif > 0)
                <span class="badge bg-danger ms-auto">{{ $aktif }}</span>
                @endif
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('pengembalian.index') }}"
               class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-return-left"></i>Pengembalian
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('denda.index') }}"
               class="nav-link {{ request()->routeIs('denda.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>Denda
                @php $belumBayar = \App\Models\Denda::where('status_bayar','belum_bayar')->count(); @endphp
                @if($belumBayar > 0)
                <span class="badge bg-warning text-dark ms-auto">{{ $belumBayar }}</span>
                @endif
            </a>
        </li>

        @if(auth()->user()->role === 'admin')
        <span class="nav-section-title">Admin</span>

        <li class="nav-item">
            <a href="{{ route('activity-log.index') }}"
               class="nav-link {{ request()->routeIs('activity-log.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>Activity Log
            </a>
        </li>
        @endif

    </ul>

    {{-- User Footer --}}
    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="rounded-circle bg-white bg-opacity-15 d-flex align-items-center
                        justify-content-center text-white flex-shrink-0"
                 style="width:34px;height:34px">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="overflow-hidden">
                <div class="user-info-name">{{ auth()->user()->name }}</div>
                <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 'primary' }}"
                      style="font-size:.6rem">
                    {{ strtoupper(auth()->user()->role) }}
                </span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="btn btn-sm w-100 text-white border-white border-opacity-25"
                    style="background:rgba(255,255,255,.08)">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>

</nav>

{{-- ── TOPBAR ──────────────────────────────────────── --}}
<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        {{-- Mobile toggle --}}
        <button class="btn btn-sm btn-outline-secondary d-md-none border-0"
                onclick="toggleSidebar()">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div>
            <h6 class="mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h6>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-sm mb-0" style="font-size:.75rem">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="text-muted small d-none d-md-block">
            {{ now()->format('d M Y') }}
        </span>
        <div class="vr d-none d-md-block" style="height:20px"></div>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary border-0 d-flex align-items-center gap-2"
                    data-bs-toggle="dropdown">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center
                            text-white" style="width:28px;height:28px;font-size:.75rem">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="d-none d-md-block small fw-semibold">
                    {{ auth()->user()->name }}
                </span>
                <i class="bi bi-chevron-down small"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width:200px">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                    <div class="text-muted" style="font-size:.75rem">{{ auth()->user()->email }}</div>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger small py-2">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Sidebar Mobile Toggle ──────────────────────
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }

    // ── Auto-dismiss alert setelah 4 detik ────────
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(el);
            bsAlert.close();
        });
    }, 4000);

    // ── Konfirmasi hapus global ────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-confirm]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                if (!confirm(this.dataset.confirm)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

@stack('scripts')
</body>
</html>