<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="text-center px-4">
        <div class="mb-4" style="font-size:5rem;color:#dc3545;">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h1 class="display-4 fw-bold text-danger">403</h1>
        <h4 class="fw-semibold mb-2">Akses Ditolak</h4>
        <p class="text-muted mb-4">
            Kamu tidak memiliki izin untuk mengakses halaman ini.
        </p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="bi bi-house me-1"></i>Dashboard
        </a>
    </div>
</body>

</html>