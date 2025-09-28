<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Arsip Surat - Unggah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin:0; }
        .sidebar { width: 220px; background:#f8f9fa; padding:20px; border-right:1px solid #ccc; }
        .content { flex:1; padding:20px; }
        .form-file-group { display: flex; align-items: center; }
        .form-file-input { flex-grow: 1; margin-right: 10px; }
        .btn-sm { margin-right: 5px; }
        .icon { font-size: 1.2rem; margin-right: 5px; }
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
                <a href="{{ route('about.index') }}" class="nav-link text-dark">
                    <span class="icon">ℹ️</span>About
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <h2>Arsip Surat >> Unggah</h2>
        <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.<br>
            <b>Catatan:</b> Gunakan file berformat PDF</p>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nomor Surat</label>
                <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">File Surat (PDF)</label>
                <input type="file" name="file_surat" class="form-control" accept="application/pdf" required>
            </div>

            <a href="{{ route('surat.index') }}" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</body>
</html>