<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e3a5f 0%, #2d5986 100%);
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            margin: 2px 8px;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .sidebar .nav-link i {
            width: 20px;
        }

        .sidebar-brand {
            padding: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 20px;
            margin-left: 250px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 1rem 1.2rem 0.3rem;
        }

        .badge-role-admin {
            background-color: #dc3545;
        }

        .badge-role-petugas {
            background-color: #0d6efd;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <nav class="sidebar d-flex flex-column">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}" class="text-decoration-none">
                <h5 class="text-white mb-0">
                    <i class="bi bi-book-half me-2"></i>Perpustakaan
                </h5>
                <small class="text-white-50">Digital Library</small>
            </a>
        </div>

        <ul class="nav flex-column py-2 flex-grow-1">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            {{-- Menu Umum (Admin & Petugas) --}}
            <li><span class="nav-section-title">Koleksi</span></li>
            <li class="nav-item">
                <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                    <i class="bi bi-journals me-2"></i>Data Buku
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}"
                        class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags me-2"></i>Kategori Buku
                    </a>
                </li>
            @endif

            <li><span class="nav-section-title">Sirkulasi</span></li>
            <li class="nav-item">
                <a href="{{ route('anggota.index') }}"
                    class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>Anggota
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peminjaman.index') }}"
                    class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right me-2"></i>Peminjaman
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pengembalian.index') }}"
                    class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-return-left me-2"></i>Pengembalian
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('denda.index') }}"
                    class="nav-link {{ request()->routeIs('denda.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin me-2"></i>Denda
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li><span class="nav-section-title">Admin</span></li>
                <li class="nav-item">
                    <a href="{{ route('activity-log.index') }}"
                        class="nav-link {{ request()->routeIs('activity-log.*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history me-2"></i>Activity Log
                    </a>
                </li>
            @endif
        </ul>

        {{-- User info di bawah sidebar --}}
        <div class="p-3 border-top border-white border-opacity-10">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center
                        justify-content-center text-white" style="width:36px;height:36px;">
                    <i class="bi bi-person"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-white text-truncate" style="font-size:0.85rem;max-width:140px;">
                        {{ auth()->user()->name }}
                    </div>
                    <span class="badge badge-role-{{ auth()->user()->role }}" style="font-size:0.65rem;">
                        {{ strtoupper(auth()->user()->role) }}
                    </span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- TOPBAR --}}
    <div class="topbar d-flex align-items-center justify-content-between">
        <h6 class="mb-0 text-secondary">@yield('page-title', 'Dashboard')</h6>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- Alert Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>