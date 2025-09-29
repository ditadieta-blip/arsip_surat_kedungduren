<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Kategori; // Import model Kategori

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $surat = Surat::with('kategori')->get();
        $query = Surat::with('kategori');
        // Jika ada parameter search
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $surat = $query->get();
        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        // Ambil data kategori dari database untuk ditampilkan di dropdown form
        $kategoris = Kategori::all();
        return view('surat.create', compact('kategoris'));
    }

    public function show($id)
    {
        // Ambil surat beserta kategori-nya
        $surat = Surat::with('kategori')->findOrFail($id);

        // Kirim ke view
        return view('surat.show', compact('surat'));
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->lokasi_file && \Storage::disk('public')->exists($surat->lokasi_file)) {
            \Storage::disk('public')->delete($surat->lokasi_file);
        }
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Arsip surat berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
        'nomor_surat' => 'required|string|unique:surat,nomor_surat',
        'kategori' => 'required|exists:kategori,id',
        'judul' => 'required|string|max:255',
        'file_surat' => 'required|mimes:pdf|max:10240',
        ]);

        $idKategori = $request->kategori;

        // 3. Simpan file PDF ke storage
        $filePath = $request->file('file_surat')->store('arsip', 'public');

        Surat::create([
        'nomor_surat' => $request->nomor_surat,
        'id_kategori' => $request->kategori,
        'judul' => $request->judul,
        'lokasi_file' => $filePath,
        ]);

        
        return redirect()->route('surat.index')->with('success', 'Data berhasil disimpan.');
    }
    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        // Pastikan file ada
        $filePath = storage_path('app/public/' . $surat->lokasi_file);
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Force download
        return response()->download($filePath, $surat->judul . '.pdf');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kategoris = Kategori::all(); // Untuk dropdown kategori jika ingin ganti
        return view('surat.edit', compact('surat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|unique:surat,nomor_surat,' . $surat->id,
            'kategori' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:255',
            'file_surat' => 'nullable|mimes:pdf|max:10240',
        ]);

        $surat->nomor_surat = $request->nomor_surat;
        $surat->id_kategori = $request->kategori;
        $surat->judul = $request->judul;

        if ($request->hasFile('file_surat')) {
            // Hapus file lama jika ada
            if ($surat->lokasi_file && \Storage::disk('public')->exists($surat->lokasi_file)) {
                \Storage::disk('public')->delete($surat->lokasi_file);
            }
            $surat->lokasi_file = $request->file('file_surat')->store('arsip', 'public');
        }

        $surat->save();

        return redirect()->route('surat.show', $surat->id)->with('success', 'Data surat berhasil diperbarui.');
    }

}