<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Kategori;
use App\Models\Daerah;
use App\Models\Sektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
public function index(Request $request)
{
    // Query utama untuk tabel
    $query = Umkm::with(['kategori', 'daerah', 'sektor']);

    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }
    if ($request->filled('daerah_id')) {
        $query->where('daerah_id', $request->daerah_id);
    }
    if ($request->filled('sektor_id')) {
        $query->where('sektor_id', $request->sektor_id);
    }

    $umkms = $query->orderBy('id', 'asc')->paginate(10);

    // Query untuk statistik umum (ikut filter tabel)
    $filteredQuery = Umkm::query();
    if ($request->filled('kategori_id')) {
        $filteredQuery->where('kategori_id', $request->kategori_id);
    }
    if ($request->filled('daerah_id')) {
        $filteredQuery->where('daerah_id', $request->daerah_id);
    }
    if ($request->filled('sektor_id')) {
        $filteredQuery->where('sektor_id', $request->sektor_id);
    }

    $totalUmkm     = $filteredQuery->count();
    $totalKaryawan = $filteredQuery->sum('jumlah_karyawan');
    $tahunSekarang = now()->year;

    $statistikBulanan = (clone $filteredQuery)
        ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
        ->whereYear('created_at', $tahunSekarang)
        ->groupBy('bulan')
        ->pluck('total', 'bulan');

    $statistikTahunan = (clone $filteredQuery)
        ->selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
        ->groupBy('tahun')
        ->orderBy('tahun', 'asc')
        ->pluck('total', 'tahun');

    // Data master
    $kategoris = Kategori::all();
    $daerahs   = Daerah::all();
    $sektors   = Sektor::all();

    // --- Chart daerah (filter kategori & sektor berlaku, daerah diabaikan) ---
    $daerahQuery = Umkm::query();
    if ($request->filled('kategori_id')) {
        $daerahQuery->where('kategori_id', $request->kategori_id);
    }
    if ($request->filled('sektor_id')) {
        $daerahQuery->where('sektor_id', $request->sektor_id);
    }

    $daerahCountsRaw = $daerahQuery
        ->selectRaw('daerah_id, COUNT(*) as total')
        ->groupBy('daerah_id')
        ->pluck('total', 'daerah_id');

    $daerahData = $daerahs->map(fn($d) => [
        'label' => $d->nama,
        'total' => $daerahCountsRaw[$d->id] ?? 0
    ]);
    $daerahLabels = $daerahData->pluck('label');
    $daerahCounts = $daerahData->pluck('total');

    // --- Chart kategori (filter daerah & sektor berlaku, kategori diabaikan) ---
    $kategoriQuery = Umkm::query();
    if ($request->filled('daerah_id')) {
        $kategoriQuery->where('daerah_id', $request->daerah_id);
    }
    if ($request->filled('sektor_id')) {
        $kategoriQuery->where('sektor_id', $request->sektor_id);
    }

    $kategoriCountsRaw = $kategoriQuery
        ->selectRaw('kategori_id, COUNT(*) as total')
        ->groupBy('kategori_id')
        ->pluck('total', 'kategori_id');

    $kategoriData = $kategoris->map(fn($k) => [
        'label' => $k->nama,
        'total' => $kategoriCountsRaw[$k->id] ?? 0
    ]);
    $kategoriLabels = $kategoriData->pluck('label');
    $kategoriCounts = $kategoriData->pluck('total');

    // --- Chart sektor (filter kategori & daerah berlaku, sektor diabaikan) ---
    $sektorQuery = Umkm::query();
    if ($request->filled('kategori_id')) {
        $sektorQuery->where('kategori_id', $request->kategori_id);
    }
    if ($request->filled('daerah_id')) {
        $sektorQuery->where('daerah_id', $request->daerah_id);
    }

    $sektorCountsRaw = $sektorQuery
        ->selectRaw('sektor_id, COUNT(*) as total')
        ->groupBy('sektor_id')
        ->pluck('total', 'sektor_id');

    $sektorData = $sektors->map(fn($s) => [
        'label' => $s->nama,
        'total' => $sektorCountsRaw[$s->id] ?? 0
    ]);
    $sektorLabels = $sektorData->pluck('label');
    $sektorCounts = $sektorData->pluck('total');

    return view('admin.umkm.index', compact(
        'umkms',
        'totalUmkm',
        'totalKaryawan',
        'statistikBulanan',
        'statistikTahunan',
        'tahunSekarang',
        'daerahLabels',
        'daerahCounts',
        'sektorLabels',
        'sektorCounts',
        'kategoriLabels',
        'kategoriCounts',
        'kategoris',
        'daerahs',
        'sektors'
    ));
}


    public function create()
    {
        $kategoris = Kategori::all();
        $daerahs   = Daerah::all();
        $sektors   = Sektor::all();
        return view('admin.umkm.create', compact('kategoris', 'daerahs', 'sektors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:150',
            'pemilik'         => 'nullable|string|max:100',
            'alamat'          => 'nullable|string|max:255',
            'no_telp'         => 'nullable|digits_between:10,13|regex:/^[0-9]+$/',
            'jumlah_karyawan' => 'nullable|integer|min:0|max:100000',
            'kategori_id'     => 'required|exists:kategoris,id',
            'daerah_id'       => 'required|exists:daerahs,id',
            'sektor_id'       => 'required|exists:sektors,id',
        ], [
            'nama.required'            => 'Nama UMKM wajib diisi.',
            'nama.max'                 => 'Nama maksimal 150 karakter.',
            'pemilik.max'              => 'Nama pemilik maksimal 100 karakter.',
            'alamat.max'               => 'Alamat maksimal 255 karakter.',
            'no_telp.digits_between'   => 'Nomor telepon harus 10–13 digit.',
            'no_telp.regex'            => 'Nomor telepon hanya boleh berisi angka.',
            'jumlah_karyawan.integer'  => 'Jumlah karyawan harus berupa angka.',
            'jumlah_karyawan.min'      => 'Jumlah karyawan minimal 0.',
            'jumlah_karyawan.max'      => 'Jumlah karyawan terlalu besar.',
            'kategori_id.required'     => 'Kategori wajib dipilih.',
            'kategori_id.exists'       => 'Kategori tidak valid.',
            'daerah_id.required'       => 'Daerah wajib dipilih.',
            'daerah_id.exists'         => 'Daerah tidak valid.',
            'sektor_id.required'       => 'Sektor wajib dipilih.',
            'sektor_id.exists'         => 'Sektor tidak valid.',
        ]);

        Umkm::create($request->only([
            'nama',
            'pemilik',
            'alamat',
            'no_telp',
            'jumlah_karyawan',
            'kategori_id',
            'daerah_id',
            'sektor_id',
        ]));

        return redirect()->route('admin.umkm.index')
                        ->with('success', 'Data UMKM berhasil ditambahkan');
        }

        public function update(Request $request, Umkm $umkm)
        {
        $request->validate([
            'nama'            => 'required|string|max:150',
            'pemilik'         => 'nullable|string|max:100',
            'alamat'          => 'nullable|string|max:255',
            'no_telp'         => 'nullable|digits_between:10,13|regex:/^[0-9]+$/',
            'jumlah_karyawan' => 'nullable|integer|min:0|max:100000',
            'kategori_id'     => 'required|exists:kategoris,id',
            'daerah_id'       => 'required|exists:daerahs,id',
            'sektor_id'       => 'required|exists:sektors,id',
        ], [
            'nama.required'            => 'Nama UMKM wajib diisi.',
            'nama.max'                 => 'Nama maksimal 150 karakter.',
            'pemilik.max'              => 'Nama pemilik maksimal 100 karakter.',
            'alamat.max'               => 'Alamat maksimal 255 karakter.',
            'no_telp.digits_between'   => 'Nomor telepon harus 10–13 digit.',
            'no_telp.regex'            => 'Nomor telepon hanya boleh berisi angka.',
            'jumlah_karyawan.integer'  => 'Jumlah karyawan harus berupa angka.',
            'jumlah_karyawan.min'      => 'Jumlah karyawan minimal 0.',
            'jumlah_karyawan.max'      => 'Jumlah karyawan terlalu besar.',
            'kategori_id.required'     => 'Kategori wajib dipilih.',
            'kategori_id.exists'       => 'Kategori tidak valid.',
            'daerah_id.required'       => 'Daerah wajib dipilih.',
            'daerah_id.exists'         => 'Daerah tidak valid.',
            'sektor_id.required'       => 'Sektor wajib dipilih.',
            'sektor_id.exists'         => 'Sektor tidak valid.',
        ]);

        $umkm->update($request->only([
            'nama',
            'pemilik',
            'alamat',
            'no_telp',
            'jumlah_karyawan',
            'kategori_id',
            'daerah_id',
            'sektor_id',
    ]));

        return redirect()->route('admin.umkm.index')
                        ->with('success', 'Data UMKM berhasil diperbarui');
    }


    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Data UMKM berhasil dihapus');
    }
}
