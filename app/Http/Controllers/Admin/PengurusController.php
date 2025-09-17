<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nama'      => 'required|unique:penguruses,nama|min:3|max:100',
            'jabatan'   => 'required|min:3|max:100',
            'deskripsi' => 'required|string|min:10',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required'      => 'Nama wajib diisi.',
            'nama.min'           => 'Nama minimal 3 karakter.',
            'jabatan.required'   => 'Jabatan wajib diisi.',
            'jabatan.min'        => 'Jabatan minimal 3 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'gambar.required'    => 'Foto pengurus wajib diupload.',
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');
        $data['gambar'] = $request->file('gambar')->store('pengurus', 'public');

        Pengurus::create($data);

        return redirect()->route('admin.penguruses.index')
                         ->with('success', 'Pengurus berhasil ditambahkan');
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $request->validate([
            'nama'      => 'required|min:3|max:100|unique:penguruses,nama,' . $pengurus->id,
            'jabatan'   => 'required|min:3|max:100',
            'deskripsi' => 'required|string|min:10',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required'      => 'Nama wajib diisi.',
            'nama.min'           => 'Nama minimal 3 karakter.',
            'jabatan.required'   => 'Jabatan wajib diisi.',
            'jabatan.min'        => 'Jabatan minimal 3 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.mimes'       => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');

        if ($request->hasFile('gambar')) {
            if ($pengurus->gambar && Storage::disk('public')->exists($pengurus->gambar)) {
                Storage::disk('public')->delete($pengurus->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.penguruses.index')
                        ->with('success', 'Pengurus berhasil diperbarui');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->gambar && Storage::disk('public')->exists($pengurus->gambar)) {
            Storage::disk('public')->delete($pengurus->gambar);
        }

        $pengurus->delete();

        return redirect()->route('admin.penguruses.index')
                         ->with('success', 'Pengurus berhasil dihapus');
    }
}
