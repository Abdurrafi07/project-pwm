<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class PublicLowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::where('status', 'aktif')
            ->where('tanggal_akhir', '>=', now());

        // Fitur search berdasarkan judul
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $lowongans = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // agar query ?q=... tetap terbawa saat paginate

        return view('noauth.lowongan.index', compact('lowongans'));
    }

    public function show(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'aktif' || $lowongan->tanggal_akhir < now()) {
            abort(404, 'Lowongan tidak tersedia');
        }

        return view('noauth.lowongan.show', compact('lowongan'));
    }
}
