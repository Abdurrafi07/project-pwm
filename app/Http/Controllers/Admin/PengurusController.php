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
            'nama'=> [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:penguruses,nama',
            ],
            'jabatan'   => 'required|min:3|max:100',
            'deskripsi' => 'nullable|string|min:10|max:500',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_temp' => 'nullable|string'
        ], [
            'nama.required'    => 'Nama wajib diisi.',
            'nama.max'         => 'Nama maksimal 100 karakter.',
            'nama.unique'      => 'Nama sudah digunakan.',
            'nama.regex'       => 'Nama hanya boleh menggunakan huruf dan spasi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.min'      => 'Jabatan minimal 3 karakter.',
            'deskripsi.min'    => 'Deskripsi minimal 10 karakter.',
            'deskripsi.max'    => 'Deskripsi maksimal 500 karakter.',
            'gambar.image'     => 'File harus berupa gambar.',
            'gambar.mimes'     => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'gambar.max'       => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');

        // Jika ada upload baru
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengurus', 'public');
        }
        // Jika tidak ada upload baru tapi ada gambar temp
        elseif ($request->filled('gambar_temp') && Storage::disk('public')->exists('tmp/'.$request->gambar_temp)) {
            $filename = 'pengurus/'.$request->gambar_temp;
            Storage::disk('public')->move('tmp/'.$request->gambar_temp, $filename);
            $data['gambar'] = $filename;
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
            'nama'=> [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:penguruses,nama,'.$pengurus->id,
            ],
            'jabatan'   => 'required|min:3|max:100',
            'deskripsi' => 'nullable|string|min:10|max:500',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_temp' => 'nullable|string'
        ]);

        $data = $request->only('nama', 'jabatan', 'deskripsi');

        if ($request->hasFile('gambar')) {
            if ($pengurus->gambar && Storage::disk('public')->exists($pengurus->gambar)) {
                Storage::disk('public')->delete($pengurus->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengurus', 'public');
        } elseif ($request->filled('gambar_temp') && Storage::disk('public')->exists('tmp/'.$request->gambar_temp)) {
            // pindahkan dari tmp ke folder pengurus
            if ($pengurus->gambar && Storage::disk('public')->exists($pengurus->gambar)) {
                Storage::disk('public')->delete($pengurus->gambar);
            }
            $filename = 'pengurus/'.$request->gambar_temp;
            Storage::disk('public')->move('tmp/'.$request->gambar_temp, $filename);
            $data['gambar'] = $filename;
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

    // 🔹 Upload sementara
    public function uploadTemp(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = uniqid().'.'.$request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->storeAs('tmp', $filename, 'public');

        return response()->json(['filename' => $filename]);
    }
}
