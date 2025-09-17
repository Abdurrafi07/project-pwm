<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;

class PublicLowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::where('status', 'aktif')
            ->where('tanggal_akhir', '>=', now()) // bukan whereDate
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
