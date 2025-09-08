<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← ini penting
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
            'judul' => 'required|unique:news,judul|max:150',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'penulis' => 'required|string|max:100',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');

        if ($request->hasFile('gambar')) {
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
            'judul' => 'required|max:150|unique:news,judul,' . $news->id,
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'penulis' => 'required|string|max:100',
        ]);

        $data = $request->only('judul', 'deskripsi', 'penulis');

        if ($request->hasFile('gambar')) {
            // Hapus file lama
            if ($news->gambar) {
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
        if ($news->gambar) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
                         ->with('success', 'Berita berhasil dihapus');
    }
}
