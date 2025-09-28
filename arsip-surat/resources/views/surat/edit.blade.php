<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar { width: 220px; background: #f8f9fa; padding: 20px; border-right: 1px solid #ccc; }
        .content { flex: 1; padding: 20px; }
        .btn-sm { margin-right: 5px; }
        .icon { font-size: 1.2rem; margin-right: 5px; }
        .alert-top {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
            min-width: 300px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
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
                <a href="{{ route('about.index') }}" class="nav-link text-dark">
                    <span class="icon">ℹ️</span>About
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Arsip Surat >> Edit/Ganti File</h2>

        @if(session('success'))
            <div class="alert alert-success alert-top">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ (old('kategori', $surat->id_kategori) == $kategori->id) ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $surat->judul) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti File Surat (PDF)</label>
                <input type="file" name="file_surat" class="form-control" accept="application/pdf">
                @if($surat->lokasi_file)
                    <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $surat->lokasi_file) }}" target="_blank">{{ $surat->lokasi_file }}</a></small>
                @endif
                <small class="text-muted d-block">Kosongkan jika tidak ingin mengganti file</small>
            </div>

            <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert-top');
            if(alert) alert.remove();
        }, 3000);
    </script>
</body>
</html>
