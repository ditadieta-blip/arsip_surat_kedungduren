<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin:0; }
        .sidebar { width: 220px; background: #f8f9fa; padding: 20px; }
        .content { flex: 1; padding: 20px; }
        .btn-sm { margin-right: 5px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h5>Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">Arsip</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Kategori Surat</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
