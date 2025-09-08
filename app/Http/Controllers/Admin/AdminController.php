<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← ini penting
use App\Models\Umkm;
use App\Models\News;
use App\Models\Pengurus;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        // Contoh statistik untuk landing dashboard admin
        $totalUmkm     = Umkm::count();
        $totalNews     = News::count();
        $totalPengurus = Pengurus::count();

        return view('admin.dashboard.index', compact('totalUmkm', 'totalNews', 'totalPengurus'));
    }
}