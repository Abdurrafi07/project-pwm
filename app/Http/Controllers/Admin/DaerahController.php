<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function index()
    {
        $daerahs = Daerah::withCount('umkms')
            ->latest()
            ->paginate(10);

        return view('admin.daerah.index', compact('daerahs'));
    }

    public function create()
    {
        return view('admin.daerah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|min:3|max:100|unique:daerahs,nama',
            'deskripsi' => 'required|string|min:10',
        ], [
            'nama.required'      => 'Nama daerah wajib diisi.',
            'nama.min'           => 'Nama daerah minimal 3 karakter.',
            'nama.max'           => 'Nama daerah maksimal 100 karakter.',
            'nama.unique'        => 'Nama daerah sudah digunakan.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
        ]);

        Daerah::create($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.daerah.index')
                         ->with('success', 'Daerah berhasil ditambahkan');
    }

    public function edit(Daerah $daerah)
    {
        return view('admin.daerah.edit', compact('daerah'));
    }

    public function update(Request $request, Daerah $daerah)
    {
        $request->validate([
            'nama'      => 'required|string|min:3|max:100|unique:daerahs,nama,' . $daerah->id,
            'deskripsi' => 'required|string|min:10',
        ], [
            'nama.required'      => 'Nama daerah wajib diisi.',
            'nama.min'           => 'Nama daerah minimal 3 karakter.',
            'nama.max'           => 'Nama daerah maksimal 100 karakter.',
            'nama.unique'        => 'Nama daerah sudah digunakan.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
        ]);

        $daerah->update($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.daerah.index')
                         ->with('success', 'Daerah berhasil diperbarui');
    }

    public function destroy(Daerah $daerah)
    {
        $daerah->delete();

        return redirect()->route('admin.daerah.index')
                         ->with('success', 'Daerah berhasil dihapus');
    }
}
