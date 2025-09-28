<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lihat Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar { width: 220px; background: #f8f9fa; padding: 20px; border-right: 1px solid #ccc; }
        .content { flex: 1; padding: 20px; }
        .icon { font-size: 1.2rem; margin-right: 5px; }
        .document-viewer {
            border: 1px solid #ccc;
            height: 600px; /* Atur tinggi sesuai kebutuhan */
            width: 100%;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            overflow: auto; /* Untuk scrolling jika konten melebihi batas */
        }
        .info-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h5>Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link active fw-bold text-dark">
                    <span class="icon">⭐</span>Arsip
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <span class="icon">📄</span>Kategori Surat
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <span class="icon">ℹ️</span>About
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <h2>Arsip Surat >> Lihat</h2>

        <div class="info-section">
            <p><strong>Nomor:</strong> {{ $surat->nomor_surat }}</p>
            <p><strong>Kategori:</strong> {{ $surat->kategori->nama ?? '-' }}</p>
            <p><strong>Judul:</strong> {{ $surat->judul }}</p>
            <p><strong>Waktu Unggah:</strong> {{ $surat->tanggal_pengarsipan ?? $surat->created_at }}</p>
        </div>

        <div class="document-viewer">
            <!-- Menampilkan PDF jika file ada -->
            @if($surat->lokasi_file)
                <iframe src="{{ asset('storage/' . $surat->lokasi_file) }}" style="width:100%; height:100%;" frameborder="0"></iframe>
            @else
                <p>Dokumen tidak tersedia</p>
            @endif
        </div>

        <div class="d-flex justify-content-start gap-2 mt-3">
            <a href="{{ route('surat.index') }}" class="btn btn-secondary"><< Kembali</a>
            <a href="{{ asset('storage/' . $surat->lokasi_file) }}" class="btn btn-warning text-dark" download>Unduh</a>
            <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-primary">Edit/Ganti File</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>