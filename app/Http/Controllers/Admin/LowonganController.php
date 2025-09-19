<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::query();

        if ($request->has('q') && $request->q != '') {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $lowongans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|min:10|max:255',
            'deskripsi'    => 'required|string|min:100|max:1500',
            'perusahaan'   => 'required|string|min:3|max:255',
            'lokasi'       => 'required|string|min:3|max:255',
            'no_hp'        => 'required|regex:/^[0-9]{10,13}$/',
            'gambar'       => 'required|image|mimes:jpg,jpeg,png|max:2048', // store
            'gambar_temp'  => 'nullable|string', // ADDED
            'tanggal_mulai'=> 'required|date',
            'tanggal_akhir'=> 'required|date|after_or_equal:tanggal_mulai',
        ], [
            'judul.required'        => 'Judul lowongan harus diisi.',
            'judul.min'             => 'Judul minimal 10 karakter.',
            'judul.max'             => 'Judul maksimal 255 karakter.',
            'deskripsi.required'    => 'Deskripsi lowongan harus diisi.',
            'deskripsi.min'         => 'Deskripsi minimal 100 karakter.',
            'deskripsi.max'         => 'Deskripsi maksimal 1500 karakter.',
            'perusahaan.required'   => 'Nama perusahaan harus diisi.',
            'perusahaan.min'        => 'Nama perusahaan minimal 3 karakter.',
            'perusahaan.max'        => 'Nama perusahaan maksimal 255 karakter.',
            'lokasi.required'       => 'Lokasi perusahaan harus diisi.',
            'lokasi.min'            => 'Lokasi minimal 3 karakter.',
            'lokasi.max'            => 'Lokasi maksimal 255 karakter.',
            'no_hp.required'        => 'Nomor HP/WA wajib diisi.',
            'no_hp.regex'           => 'Nomor HP/WA harus berupa angka 10–13 digit.',
            'gambar.required'       => 'Gambar lowongan wajib diunggah.',
            'gambar.image'          => 'File gambar harus berupa jpg, jpeg, atau png.',
            'gambar.max'            => 'Ukuran gambar maksimal 2MB.',
            'tanggal_mulai.required'=> 'Tanggal mulai lowongan wajib diisi.',
            'tanggal_akhir.required'=> 'Tanggal akhir lowongan wajib diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.',
        ]);

        $data = $request->only('judul','deskripsi','perusahaan','lokasi','no_hp','tanggal_mulai','tanggal_akhir');

        // Gunakan gambar temp jika ada, kalau tidak, ambil dari upload biasa
        if ($request->filled('gambar_temp')) { // ADDED
            $tempPath = 'tmp/' . $request->gambar_temp; // ADDED
            if (Storage::disk('public')->exists($tempPath)) { // ADDED
                $newName = 'lowongan/' . Str::random(10) . '_' . $request->gambar_temp; // ADDED
                Storage::disk('public')->move($tempPath, $newName); // ADDED
                $data['gambar'] = $newName; // ADDED
            }
        } elseif ($request->hasFile('gambar')) { // ADDED
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public'); // ADDED
        }

        Lowongan::create($data);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Lowongan $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'judul'        => 'required|string|min:10|max:255',
            'deskripsi'    => 'required|string|min:100|max:1500',
            'perusahaan'   => 'required|string|min:3|max:255',
            'lokasi'       => 'required|string|min:3|max:255',
            'no_hp'        => 'required|regex:/^[0-9]{10,13}$/',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ADDED nullable
            'gambar_temp'  => 'nullable|string', // ADDED
            'tanggal_mulai'=> 'required|date',
            'tanggal_akhir'=> 'required|date|after_or_equal:tanggal_mulai',
        ], [
            'judul.required'        => 'Judul lowongan harus diisi.',
            'judul.min'             => 'Judul minimal 10 karakter.',
            'judul.max'             => 'Judul maksimal 255 karakter.',
            'deskripsi.required'    => 'Deskripsi lowongan harus diisi.',
            'deskripsi.min'         => 'Deskripsi minimal 100 karakter.',
            'deskripsi.max'         => 'Deskripsi maksimal 1500 karakter.',
            'perusahaan.required'   => 'Nama perusahaan harus diisi.',
            'perusahaan.min'        => 'Nama perusahaan minimal 3 karakter.',
            'perusahaan.max'        => 'Nama perusahaan maksimal 255 karakter.',
            'lokasi.required'       => 'Lokasi perusahaan harus diisi.',
            'lokasi.min'            => 'Lokasi minimal 3 karakter.',
            'lokasi.max'            => 'Lokasi maksimal 255 karakter.',
            'no_hp.required'        => 'Nomor HP/WA wajib diisi.',
            'no_hp.regex'           => 'Nomor HP/WA harus berupa angka 10–13 digit.',
            'gambar.image'          => 'File gambar harus berupa jpg, jpeg, atau png.',
            'gambar.max'            => 'Ukuran gambar maksimal 2MB.',
            'tanggal_mulai.required'=> 'Tanggal mulai lowongan wajib diisi.',
            'tanggal_akhir.required'=> 'Tanggal akhir lowongan wajib diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.',
        ]);

        $data = $request->only('judul','deskripsi','perusahaan','lokasi','no_hp','tanggal_mulai','tanggal_akhir');


        if ($request->filled('gambar_temp')) { // ADDED
            $tempPath = 'tmp/' . $request->gambar_temp; // ADDED
            if (Storage::disk('public')->exists($tempPath)) { // ADDED
                if ($lowongan->gambar && Storage::disk('public')->exists($lowongan->gambar)) { // ADDED
                    Storage::disk('public')->delete($lowongan->gambar); // ADDED
                }
                $newName = 'lowongan/' . Str::random(10) . '_' . $request->gambar_temp; // ADDED
                Storage::disk('public')->move($tempPath, $newName); // ADDED
                $data['gambar'] = $newName; // ADDED
            }
        } elseif ($request->hasFile('gambar')) { // ADDED
            if ($lowongan->gambar && Storage::disk('public')->exists($lowongan->gambar)) { // ADDED
                Storage::disk('public')->delete($lowongan->gambar); // ADDED
            }
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public'); // ADDED
        }

        $lowongan->update($data);

        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        if ($lowongan->gambar && Storage::disk('public')->exists($lowongan->gambar)) {
            Storage::disk('public')->delete($lowongan->gambar);
        }
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function history(Request $request)
    {
        $query = Lowongan::where('tanggal_akhir', '<', now())
            ->orWhere('status', 'nonaktif');

        if ($request->has('q') && $request->q != '') {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $lowongans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.lowongan.history', compact('lowongans'));
    }

    /**
     * Upload sementara untuk preview gambar sebelum submit
     */
    public function uploadTemp(Request $request) // ADDED
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        $filename = Str::random(10) . '_' . $file->getClientOriginalName();
        $file->storeAs('tmp', $filename, 'public');

        return response()->json(['filename' => $filename]);
    }
}