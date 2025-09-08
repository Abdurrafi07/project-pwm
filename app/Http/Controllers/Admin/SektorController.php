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
            'nama' => 'required|unique:sektors,nama|max:100',
            'deskripsi' => 'nullable|string',
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
            'nama' => 'required|max:100|unique:sektors,nama,' . $sektor->id,
            'deskripsi' => 'nullable|string',
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
