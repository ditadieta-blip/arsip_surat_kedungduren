<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriSuratController;

// Halaman About statis
Route::get('/about', function () {
    return view('about');
})->name('about.index');

// Semua route untuk Surat (index, create, store, show, destroy)
Route::resource('surat', SuratController::class);
Route::get('surat', [SuratController::class, 'index'])->name('surat.index');

// Tambahan untuk unduh file surat
Route::get('surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');
// Route::get('/kategori-surat/create', [KategoriSuratController::class, 'create'])->name('kategori.create');

// Semua route untuk Kategori Surat
Route::resource('kategori-surat', KategoriSuratController::class)->names('kategori');
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

// Redirect root ke daftar surat
Route::get('/', function () {
    return redirect()->route('surat.index');
});
