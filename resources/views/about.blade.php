<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 220px;
            background: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ccc;
        }
        .content {
            flex: 1;
            padding: 30px;
        }
        .icon {
            font-size: 1.2rem;
            margin-right: 5px;
        }
        .about-card {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-top: 30px;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            background-color: #eee;
            color: #555;
            overflow: hidden;
        }
        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info {
            font-size: 1.1rem;
            line-height: 1.8;
        }
        .info strong {
            display: inline-block;
            width: 80px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h5>Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('surat.index') }}" class="nav-link text-dark">
                    <span class="icon">⭐</span>Arsip
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}" class="nav-link text-dark">
                    <span class="icon">📄</span>Kategori Surat
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('about.index') }}" class="nav-link active fw-bold text-dark">
                    <span class="icon">ℹ️</span>About
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <h2>About</h2>
        <div class="about-card">
            <div class="profile-photo">
                <img src="{{ asset('images/ardita.jpg') }}" alt="Foto Profil Ardita">
            </div>
            <div class="info">
                <p>Aplikasi ini dibuat oleh:</p>
                <p>
                    <strong>Nama</strong> : Ardita Rif'atul Umami<br>
                    <strong>Prodi</strong> : D3-MI PSDKU Kediri<br>
                    <strong>NIM</strong> : 2331730026<br>
                    <strong>Tanggal</strong> : 25 September 2025
                </p>
            </div>
        </div>
    </div>
</body>
</html>