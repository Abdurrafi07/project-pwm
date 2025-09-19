<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sektor;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    public function index()
    {
        $sektors = Sektor::withCount('umkms')
            ->latest()
            ->paginate(10);

        return view('admin.sektor.index', compact('sektors'));
    }

    public function create()
    {
        return view('admin.sektor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:sektors,nama' . (isset($sektor) ? ',' . $sektor->id : ''),
            ],
            'deskripsi' => 'nullable|string|min:10|max:100',
        ], [
            'nama.required'      => 'Nama sektor wajib diisi.',
            'nama.max'           => 'Nama sektor maksimal 100 karakter.',
            'nama.unique'        => 'Nama sektor sudah digunakan.',
            'nama.regex'         => 'Nama sektor hanya boleh menggunakan huruf dan spasi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 100 karakter.',
        ]);

        Sektor::create($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.sektor.index')
                         ->with('success', 'Sektor berhasil ditambahkan');
    }

    public function edit(Sektor $sektor)
    {
        return view('admin.sektor.edit', compact('sektor'));
    }

    public function update(Request $request, Sektor $sektor)
    {
        $request->validate([
            'nama'      => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:sektors,nama' . (isset($sektor) ? ',' . $sektor->id : ''),
            ],
            'deskripsi' => 'nullable|string|min:10|max:100',
        ], [
            'nama.required'      => 'Nama sektor wajib diisi.',
            'nama.max'           => 'Nama sektor maksimal 100 karakter.',
            'nama.unique'        => 'Nama sektor sudah digunakan.',
            'nama.regex'         => 'Nama sektor hanya boleh menggunakan huruf dan spasi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 100 karakter.',
        ]);

        $sektor->update($request->only('nama', 'deskripsi'));

        return redirect()->route('admin.sektor.index')
                         ->with('success', 'Sektor berhasil diperbarui');
    }

    public function destroy(Sektor $sektor)
    {
        $sektor->delete();

        return redirect()->route('admin.sektor.index')
                         ->with('success', 'Sektor berhasil dihapus');
    }
}
