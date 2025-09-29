<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kategori Surat - Tambah/Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin:0; }
        .sidebar { width: 220px; background:#f8f9fa; padding:20px; border-right:1px solid #ccc; }
        .content { flex:1; padding:20px; }
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
                <a href="{{ route('kategori.index') }}" class="nav-link active fw-bold text-dark">
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
        @if(isset($kategori))
            <h2>Kategori Surat >> Edit</h2>
        @else
            <h2>Kategori Surat >> Tambah</h2>
        @endif
        <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>
        
        <form action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}" method="POST">
            @csrf
            @if(isset($kategori))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">ID (Auto Increment)</label>
                <input type="text" class="form-control" value="{{ isset($kategori) ? $kategori->id : 'Otomatis' }}" disabled>
            </div>

            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" id="nama_kategori" class="form-control" value="{{ isset($kategori) ? $kategori->nama : '' }}" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="deskripsi" id="keterangan" rows="5" class="form-control" required>{{ isset($kategori) ? $kategori->deskripsi : '' }}</textarea>
            </div>

            <div class="d-flex mt-4">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary me-2"><< Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>

    </div>
</body>
</html>