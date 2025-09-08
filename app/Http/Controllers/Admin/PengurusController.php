<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← ini penting
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::latest()->paginate(10);
        return view('admin.penguruses.index', compact('penguruses'));
    }

    public function create()
    {
        return view('admin.penguruses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:penguruses,nama|max:100',
            'jabatan' => 'required|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengurus', 'public');
        }

        Pengurus::create($data);

        return redirect()->route('admin.penguruses.index')
                         ->with('success', 'Pengurus berhasil ditambahkan');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.penguruses.edit', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $request->validate([
            'nama' => 'required|max:100|unique:penguruses,nama,' . $pengurus->id,
            'jabatan' => 'required|max:100',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/penguruses');
            $data['gambar'] = str_replace('public/', '', $path);
        }

        $pengurus->update($data);

        return redirect()->route('admin.penguruses.index')
                         ->with('success', 'Pengurus berhasil diperbarui');
    }

    public function destroy(Pengurus $pengurus)
    {
        $pengurus->delete();

        return redirect()->route('admin.penguruses.index')
                         ->with('success', 'Pengurus berhasil dihapus');
    }
}