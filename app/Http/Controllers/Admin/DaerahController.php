<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← ini penting
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
            'nama' => 'required|unique:daerahs,nama|max:100',
            'deskripsi' => 'nullable|string',
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
            'nama' => 'required|max:100|unique:daerahs,nama,' . $daerah->id,
            'deskripsi' => 'nullable|string',
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