<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'judul'     => 'required|string|min:10|max:150|unique:news,judul',
            'deskripsi' => 'required|string|min:100',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'penulis'   => 'required|string',
        ], [
            'judul.required'     => 'Judul berita wajib diisi.',
            'judul.min'          => 'Judul berita minimal 10 karakter.',
            'judul.max'          => 'Judul berita maksimal 150 karakter.',
            'judul.unique'       => 'Judul berita sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 100 karakter.',
            'gambar.required'    => 'Gambar wajib diupload.',
            'gambar.image'       => 'File harus berupa gambar (jpg, jpeg, png).',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
            'penulis.required'   => 'Nama penulis wajib diisi.',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');
        $data['gambar'] = $request->file('gambar')->store('news', 'public');

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
            'deskripsi' => 'required|string|min:100',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'penulis'   => 'required|string',
        ], [
            'judul.required'     => 'Judul berita wajib diisi.',
            'judul.min'          => 'Judul berita minimal 10 karakter.',
            'judul.max'          => 'Judul berita maksimal 150 karakter.',
            'judul.unique'       => 'Judul berita sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 100 karakter.',
            'gambar.required'    => 'Gambar wajib diupload.',
            'gambar.image'       => 'File harus berupa gambar (jpg, jpeg, png).',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
            'penulis.required'   => 'Nama penulis wajib diisi.',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');

        if ($request->hasFile('gambar')) {
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
}
