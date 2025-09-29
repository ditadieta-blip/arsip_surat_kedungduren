# Aplikasi Arsip Surat Kelurahan Karangduren

## Tujuan
Aplikasi ini dibuat untuk membantu perangkat desa Karangduren dalam mengarsipkan surat-surat resmi yang diterbitkan oleh kelurahan.  
Dengan adanya aplikasi ini, surat yang sudah dipindai dalam bentuk PDF dapat diunggah, disimpan, dikelola, dan dicari kembali dengan mudah, sehingga proses administrasi menjadi lebih tertata dan efisien.  

## Fitur
- **Upload Surat PDF**: Petugas dapat mengunggah file surat dalam format PDF.  
- **Pencarian Surat**: Surat dapat dicari berdasarkan judul.  
- **Unduh Surat**: Surat yang tersimpan bisa diunduh kembali kapan saja.  
- **Manajemen Surat**: CRUD data surat (tambah, edit, hapus, lihat).  
- **Manajemen Kategori Surat**: CRUD data kategori surat (tambah, edit, hapus, lihat)

## Cara Menjalankan Aplikasi
1. Clone repository:
   ```bash
   git clone https://github.com/username/arsip_surat_kelurahan_karangduren.git
   cd arsip_surat_kelurahan_karangduren
2. Install dependencies:
   ```bash
   composer install
   npm install && npm run dev

4. Copy file .env.example menjadi .env, lalu atur konfigurasi database:
   ```bash
   DB_DATABASE=arsip_surat
   DB_USERNAME=root
   DB_PASSWORD=
6. Generate app key:
   ```bash
   php artisan key:generate
8. Import database SQL:
   Buat database arsip_surat di MySQL
   Import file arsip_surat.sql yang sudah disertakan dalam repository
9. Jalankan migration (opsional jika menggunakan migration):
   ```bash
   php artisan migrate
11. Jalankan server:
    ```bash
    php artisan serve
13. Aplikasi dapat diakses di: http://127.0.0.1:8000
 ## Screenshot Aplikasi   
<img width="1365" height="632" alt="Screenshot 2025-09-28 175005" src="https://github.com/user-attachments/assets/da9140c6-11b7-4472-8b3d-1b130089553d" />
<img width="1365" height="636" alt="Screenshot 2025-09-28 175456" src="https://github.com/user-attachments/assets/24ea2416-498b-405b-b0b5-630f49626d33" />

