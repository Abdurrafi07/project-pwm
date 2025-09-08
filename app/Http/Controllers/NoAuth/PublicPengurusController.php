<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class PublicPengurusController extends Controller
{
    /**
     * Menampilkan daftar pengurus dalam bentuk card
     */
    public function index()
    {
        // Ambil semua data pengurus, urut dari yang paling lama dibuat
        $penguruses = Pengurus::orderBy('created_at', 'asc')->get();

        // Kirim ke view publik
        return view('noauth.pengurus.index', compact('penguruses'));
    }
}