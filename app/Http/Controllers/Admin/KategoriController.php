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
            'nama'      => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:kategoris,nama' . (isset($kategori) ? ',' . $kategori->id : ''),
            ],
            'deskripsi' => 'nullable|string|min:10|max:100',
        ], [
            'nama.required'      => 'Nama kategori wajib diisi.',
            'nama.max'           => 'Nama kategori maksimal 100 karakter.',
            'nama.unique'        => 'Nama kategori sudah digunakan.',
            'nama.regex'         => 'Nama kategori hanya boleh menggunakan huruf dan spasi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 100 karakter.',
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
            'nama'      => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:kategoris,nama' . (isset($kategori) ? ',' . $kategori->id : ''),
            ],
            'deskripsi' => 'nullable|string|min:10|max:100',
        ], [
            'nama.required'      => 'Nama kategori wajib diisi.',
            'nama.max'           => 'Nama kategori maksimal 100 karakter.',
            'nama.unique'        => 'Nama kategori sudah digunakan.',
            'nama.regex'         => 'Nama kategori hanya boleh menggunakan huruf dan spasi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 100 karakter.',
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
