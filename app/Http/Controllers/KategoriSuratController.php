<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriSuratController extends Controller
{

    public function index(Request $request)
    {
        // Mulai query builder
        $query = Kategori::query();

        // Filter berdasarkan search jika ada
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Ambil data kategori
        $kategoris = $query->get();

        return view('surat.kategori_surat', compact('kategoris'));
    }

    public function create()
    {
        return view('surat.tambah_edit_kategori');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($request->only(['nama','deskripsi']));

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('surat.tambah_edit_kategori', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama','deskripsi']));

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
