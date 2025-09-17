<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'nama'      => 'required|string|min:3|max:100|unique:kategoris,nama',
            'deskripsi' => 'required|string|min:10',
        ], [
            'nama.required'      => 'Nama kategori wajib diisi.',
            'nama.min'           => 'Nama kategori minimal 3 karakter.',
            'nama.max'           => 'Nama kategori maksimal 100 karakter.',
            'nama.unique'        => 'Nama kategori sudah digunakan.',
            'deskripsi.required' => 'Deskripsi kategori wajib diisi.',
            'deskripsi.min'      => 'Deskripsi kategori minimal 10 karakter.',
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
            'nama'      => 'required|string|min:3|max:100|unique:kategoris,nama,' . $kategori->id,
            'deskripsi' => 'required|string|min:10',
        ], [
            'nama.required'      => 'Nama kategori wajib diisi.',
            'nama.min'           => 'Nama kategori minimal 3 karakter.',
            'nama.max'           => 'Nama kategori maksimal 100 karakter.',
            'nama.unique'        => 'Nama kategori sudah digunakan.',
            'deskripsi.required' => 'Deskripsi kategori wajib diisi.',
            'deskripsi.min'      => 'Deskripsi kategori minimal 10 karakter.',
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
