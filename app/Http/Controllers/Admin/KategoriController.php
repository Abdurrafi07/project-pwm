<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← ini penting
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // ambil kategori sekaligus jumlah umkm yang pakai
        $kategoris = Kategori::withCount('umkms')
            ->latest()
            ->paginate(10);

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategoris,nama|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|max:100|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus');
    }
}
