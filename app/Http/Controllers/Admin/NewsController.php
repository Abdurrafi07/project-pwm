<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|min:10|max:150|unique:news,judul,',
            'deskripsi' => 'required|string|min:100|max:3000',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_temp' => 'nullable|string',
            'penulis'   => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:news,penulis' . (isset($news) ? ',' . $news->id : '')
            ],
        ], [
            'judul.required'     => 'Judul berita wajib diisi.',
            'judul.min'          => 'Judul berita minimal 10 karakter.',
            'judul.max'          => 'Judul berita maksimal 150 karakter.',
            'judul.unique'       => 'Judul berita sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 100 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 3000 karakter.',
            'gambar.image'       => 'File harus berupa gambar (jpg, jpeg, png).',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
            'penulis.required'   => 'Penulis wajib diisi.',
            'penulis.max'        => 'Penulis maksimal 100 karakter.',
            'penulis.regex'      => 'Penulis hanya boleh menggunakan huruf dan spasi.',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');

        // Gunakan gambar temp jika ada, kalau tidak, ambil dari upload biasa
        if ($request->filled('gambar_temp')) {
            $tempPath = 'tmp/' . $request->gambar_temp;
            if (Storage::disk('public')->exists($tempPath)) {
                // Pindahkan dari tmp ke folder news
                $newName = 'news/' . Str::random(10) . '_' . $request->gambar_temp;
                Storage::disk('public')->move($tempPath, $newName);
                $data['gambar'] = $newName;
            }
        } elseif ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.news.index')
                         ->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'judul'     => 'required|string|min:10|max:150|unique:news,judul,' . $news->id,
            'deskripsi' => 'required|string|min:100|max:3000',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_temp' => 'nullable|string',
            'penulis'   => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
                'unique:news,penulis' . (isset($news) ? ',' . $news->id : '')
            ],
        ], [
            'judul.required'     => 'Judul berita wajib diisi.',
            'judul.min'          => 'Judul berita minimal 10 karakter.',
            'judul.max'          => 'Judul berita maksimal 150 karakter.',
            'judul.unique'       => 'Judul berita sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 100 karakter.',
            'deskripsi.max'      => 'Deskripsi maksimal 3000 karakter.',
            'gambar.image'       => 'File harus berupa gambar (jpg, jpeg, png).',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
            'penulis.required'   => 'Penulis wajib diisi.',
            'penulis.max'        => 'Penulis maksimal 100 karakter.',
            'penulis.regex'      => 'Penulis hanya boleh menggunakan huruf dan spasi.',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');

        if ($request->filled('gambar_temp')) {
            $tempPath = 'tmp/' . $request->gambar_temp;
            if (Storage::disk('public')->exists($tempPath)) {
                // Hapus gambar lama
                if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                    Storage::disk('public')->delete($news->gambar);
                }
                $newName = 'news/' . Str::random(10) . '_' . $request->gambar_temp;
                Storage::disk('public')->move($tempPath, $newName);
                $data['gambar'] = $newName;
            }
        } elseif ($request->hasFile('gambar')) {
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
                         ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(News $news)
    {
        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
                         ->with('success', 'Berita berhasil dihapus');
    }

    /**
     * Upload sementara untuk preview gambar sebelum submit
     */
    public function uploadTemp(Request $request)
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
