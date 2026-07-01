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
        :root {
            --accent: #0f9b7a;
            --accent-dark: #0b8269;
            --accent-light: #f0fdf9;
            --card-border: #d1f5e8;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            /* subtle teal-tinted mesh background */
            background: #f0faf7;
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(15, 155, 122, .10) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 80%, rgba(15, 155, 122, .07) 0%, transparent 55%);
        }

        .auth-wrapper {
            width: 100%;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Brand header above card */
        .auth-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .auth-brand-icon {
            width: 42px;
            height: 42px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-brand-icon i {
            font-size: 1.3rem;
            color: #e0fff6;
        }

        .auth-brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d2b26;
        }

        .auth-brand-sub {
            font-size: .72rem;
            font-weight: 400;
            color: #64748b;
        }

        /* Card */
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--card-border);
            padding: 2rem 2rem 1.75rem;
        }

        .auth-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d2b26;
            margin-bottom: .25rem;
        }

        .auth-card-subtitle {
            font-size: .82rem;
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        /* Form elements */
        .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 9px;
            border-color: #d1d5db;
            font-size: .875rem;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            padding: .55rem .85rem;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(15, 155, 122, .12);
        }

        /* Password toggle wrapper */
        .input-group .form-control {
            border-radius: 9px 0 0 9px;
        }

        .input-group .btn-outline-secondary {
            border-color: #d1d5db;
            border-radius: 0 9px 9px 0;
            color: #94a3b8;
            font-size: .9rem;
        }

        .input-group .btn-outline-secondary:hover {
            background: var(--accent-light);
            color: var(--accent);
        }

        /* Primary button */
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            border-radius: 9px;
            font-weight: 700;
            font-size: .9rem;
            padding: .6rem 1rem;
            transition: background .15s;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }

        .btn-link {
            color: var(--accent);
            font-size: .82rem;
            font-weight: 600;
        }

        .btn-link:hover {
            color: var(--accent-dark);
        }

        /* Checkbox */
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(15, 155, 122, .12);
        }

        .form-check-label {
            font-size: .82rem;
            font-weight: 500;
            color: #374151;
        }

        /* Divider */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin: 1rem 0;
            color: #94a3b8;
            font-size: .75rem;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--card-border);
        }

        /* Footer note */
        .auth-footer {
            text-align: center;
            margin-top: 1.25rem;
            font-size: .78rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .auth-footer a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        {{-- Brand logo --}}
        <a href="/" class="auth-brand">
            <div class="auth-brand-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div>
                <div class="auth-brand-name">Perpustakaan</div>
                <div class="auth-brand-sub">Digital Library System</div>
            </div>
        </a>

        {{-- Auth card --}}
        <div class="auth-card">
            {{ $slot }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>