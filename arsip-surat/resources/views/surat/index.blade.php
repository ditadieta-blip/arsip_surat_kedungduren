<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar { width: 220px; background: #f8f9fa; padding: 20px; border-right:1px solid #ccc; }
        .content { flex: 1; padding: 20px; position: relative; }
        .btn-sm { margin-right: 5px; }
        .search-box { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; }
        .search-box input { flex: 1; }
        .icon { font-size: 1.2rem; margin-right: 5px; }

        
        .alert-top {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(20%);
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
                <a href="{{ route('surat.index') }}" class="nav-link active fw-bold text-dark">
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
        <h2>Arsip Surat</h2>
        <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
           Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>

        <!-- Alert sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-top">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Pencarian -->
        <div class="search-box">
            <form action="{{ route('surat.index') }}" method="GET" class="d-flex gap-2 w-100">
                <label for="search" class="form-label mb-0">Cari surat:</label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari!</button>
            </form>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Waktu Pengarsipan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($surat as $item)
                    <tr>
                        <td>{{ $item->nomor_surat }}</td>
                        <td>{{ $item->kategori->nama ?? '-' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal_pengarsipan ?? $item->created_at }}</td>
                        <td>
                            <form action="{{ route('surat.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('surat.download', $item->id) }}" class="btn btn-sm btn-warning text-dark">Unduh</a>
                            <a href="{{ route('surat.show', $item->id) }}" class="btn btn-sm btn-primary">Lihat >></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada arsip surat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('surat.create') }}" class="btn btn-success">Arsipkan Surat</a>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Alert</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus arsip surat ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Bootstrap dan Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let formToDelete;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                formToDelete = this;
                deleteModal.show();
            });
        });

        confirmDeleteBtn.addEventListener('click', function() {
            if(formToDelete){
                formToDelete.submit();
            }
        });

        setTimeout(() => {
            const alert = document.querySelector('.alert-top');
            if(alert) alert.remove();
        }, 3000);
    </script>
</body>
</html>
