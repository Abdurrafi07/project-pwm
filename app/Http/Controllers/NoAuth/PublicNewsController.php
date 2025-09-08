<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class PublicNewsController extends Controller
{
    public function index()
    {
        // Ambil semua data news, urut terbaru
        $news = News::latest()->get();

        return view('noauth.news.index', compact('news'));
    }

    public function show($id)
    {
        // Cari berita berdasarkan id
        $news = News::findOrFail($id);

        return view('noauth.news.show', compact('news'));
    }
}
