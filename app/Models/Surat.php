<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat'; // Opsional, jika nama tabel tidak sesuai
    protected $fillable = [
        'nomor_surat',
        'id_kategori',
        'judul',
        'lokasi_file',
        'tanggal_pengarsipan',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}