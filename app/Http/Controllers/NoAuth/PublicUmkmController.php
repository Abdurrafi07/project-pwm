<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Kategori;
use App\Models\Daerah;
use App\Models\Sektor;
use Illuminate\Http\Request;

class PublicUmkmController extends Controller
{
    public function index(Request $request)
    {
        // ---------------------------
        // Data Master
        // ---------------------------
        $kategoris = Kategori::all();
        $daerahs   = Daerah::all();
        $sektors   = Sektor::all();

        // ---------------------------
        // Ambil filter tahun & bulan
        // ---------------------------
        $tahunDipilih = $request->input('tahun');      // bisa angka atau 'all'
        $bulanDipilih = $request->input('bulan');      // bisa angka atau 'all'

        // Tahun default utk judul chart
        $tahunSekarang = $tahunDipilih && $tahunDipilih !== 'all'
            ? $tahunDipilih
            : date('Y');

        // ---------------------------
        // Query utama untuk tabel
        // ---------------------------
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
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // === Tambahan: filter tahun & bulan ===
        if ($request->filled('tahun') && $tahunDipilih !== 'all') {
            $query->whereYear('created_at', $tahunDipilih);
        }
        // bulan: jika ada dan bukan 'all', filter by month tanpa whereYear agar semua tahun tetap masuk
        if ($request->filled('bulan') && $bulanDipilih !== 'all') {
            $query->whereMonth('created_at', $bulanDipilih);
        }

        $umkms = $query->orderBy('id', 'asc')
            ->paginate(10)
            ->appends($request->all());

        // ---------------------------
        // Query filtered untuk statistik
        // ---------------------------
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
        if ($request->filled('nama')) {
            $filteredQuery->where('nama', 'like', '%' . $request->nama . '%');
        }

        // === Tambahan sama seperti di atas ===
        if ($request->filled('tahun') && $tahunDipilih !== 'all') {
            $filteredQuery->whereYear('created_at', $tahunDipilih);
        }
        if ($request->filled('bulan') && $bulanDipilih !== 'all') {
            $filteredQuery->whereMonth('created_at', $bulanDipilih);
        }

        $totalUmkm     = $filteredQuery->count();
        $totalKaryawan = $filteredQuery->sum('jumlah_karyawan');

        // ---------------------------
        // Statistik UMKM
        // ---------------------------
        $statistikBulanan = (clone $filteredQuery)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->when($tahunDipilih && $tahunDipilih !== 'all', fn($q) => $q->whereYear('created_at', $tahunDipilih))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Tahunan kumulatif semua tahun
        // $statistikTahunanRaw = Umkm::selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
        //     ->groupBy('tahun')
        //     ->orderBy('tahun')
        //     ->pluck('total', 'tahun');

        // Tahunan kumulatif semua tahun -> pakai filteredQuery
        $statistikTahunanRaw = (clone $filteredQuery)
            ->selectRaw('YEAR(created_at) as tahun, COUNT(*) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun');


        $cumulativeTahunan = [];
        $running = 0;
        foreach ($statistikTahunanRaw as $tahun => $total) {
            $running += $total;
            $cumulativeTahunan[$tahun] = $running;
        }
        $statistikTahunan = collect($cumulativeTahunan);

        // ---------------------------
        // Statistik Karyawan
        // ---------------------------
        $karyawanBulanan = (clone $filteredQuery)
            ->selectRaw('MONTH(created_at) as bulan, SUM(jumlah_karyawan) as total')
            ->when($tahunDipilih && $tahunDipilih !== 'all', fn($q) => $q->whereYear('created_at', $tahunDipilih))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $karyawanTahunan = (clone $filteredQuery)
            ->selectRaw('YEAR(created_at) as tahun, SUM(jumlah_karyawan) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun');

        // ---------------------------
        // Statistik Kategori Bulanan
        // ---------------------------
        $kategoriBulananRaw = (clone $filteredQuery)
            ->selectRaw('MONTH(created_at) as bulan, kategori_id, COUNT(*) as total')
            ->when($tahunDipilih && $tahunDipilih !== 'all', fn($q) => $q->whereYear('created_at', $tahunDipilih))
            ->groupBy('bulan', 'kategori_id')
            ->orderBy('bulan')
            ->get();

        $kategoriBulanan = [];
        foreach (range(1, 12) as $bulan) {
            foreach ($kategoris as $kategori) {
                $kategoriBulanan[$kategori->nama][$bulan] = 0;
            }
        }
        foreach ($kategoriBulananRaw as $row) {
            $namaKategori = $kategoris->firstWhere('id', $row->kategori_id)->nama;
            $kategoriBulanan[$namaKategori][$row->bulan] = $row->total;
        }

        $kategoriTahunanRaw = (clone $filteredQuery)
            ->selectRaw('YEAR(created_at) as tahun, kategori_id, COUNT(*) as total')
            ->groupBy('tahun', 'kategori_id')
            ->orderBy('tahun')
            ->get();

        $kategoriTahunan = [];
        foreach ($kategoriTahunanRaw as $row) {
            $namaKategori = $kategoris->firstWhere('id', $row->kategori_id)->nama;
            $kategoriTahunan[$namaKategori][$row->tahun] = $row->total;
        }

        // ---------------------------
        // Statistik Daerah Bulanan
        // ---------------------------
        $daerahBulananRaw = (clone $filteredQuery)
            ->selectRaw('MONTH(created_at) as bulan, daerah_id, COUNT(*) as total')
            ->when($tahunDipilih && $tahunDipilih !== 'all', fn($q) => $q->whereYear('created_at', $tahunDipilih))
            ->groupBy('bulan', 'daerah_id')
            ->orderBy('bulan')
            ->get();

        $daerahBulanan = [];
        foreach (range(1, 12) as $bulan) {
            foreach ($daerahs as $daerah) {
                $daerahBulanan[$daerah->nama][$bulan] = 0;
            }
        }
        foreach ($daerahBulananRaw as $row) {
            $namaDaerah = $daerahs->firstWhere('id', $row->daerah_id)->nama;
            $daerahBulanan[$namaDaerah][$row->bulan] = $row->total;
        }

        $daerahTahunanRaw = (clone $filteredQuery)
            ->selectRaw('YEAR(created_at) as tahun, daerah_id, COUNT(*) as total')
            ->groupBy('tahun', 'daerah_id')
            ->orderBy('tahun')
            ->get();

        $daerahTahunan = [];
        foreach ($daerahTahunanRaw as $row) {
            $namaDaerah = $daerahs->firstWhere('id', $row->daerah_id)->nama;
            $daerahTahunan[$namaDaerah][$row->tahun] = $row->total;
        }

        // ---------------------------
        // Statistik Sektor Bulanan
        // ---------------------------
        $sektorBulananRaw = (clone $filteredQuery)
            ->selectRaw('MONTH(created_at) as bulan, sektor_id, COUNT(*) as total')
            ->when($tahunDipilih && $tahunDipilih !== 'all', fn($q) => $q->whereYear('created_at', $tahunDipilih))
            ->groupBy('bulan', 'sektor_id')
            ->orderBy('bulan')
            ->get();

        $sektorBulanan = [];
        foreach (range(1, 12) as $bulan) {
            foreach ($sektors as $sektor) {
                $sektorBulanan[$sektor->nama][$bulan] = 0;
            }
        }
        foreach ($sektorBulananRaw as $row) {
            $namaSektor = $sektors->firstWhere('id', $row->sektor_id)->nama;
            $sektorBulanan[$namaSektor][$row->bulan] = $row->total;
        }

        $sektorTahunanRaw = (clone $filteredQuery)
            ->selectRaw('YEAR(created_at) as tahun, sektor_id, COUNT(*) as total')
            ->groupBy('tahun', 'sektor_id')
            ->orderBy('tahun')
            ->get();

        $sektorTahunan = [];
        foreach ($sektorTahunanRaw as $row) {
            $namaSektor = $sektors->firstWhere('id', $row->sektor_id)->nama;
            $sektorTahunan[$namaSektor][$row->tahun] = $row->total;
        }

        // ---------------------------
        // Chart per Daerah/Kategori/Sektor
        // ---------------------------
        // gunakan filter yang sama untuk count total
        $daerahQuery = Umkm::query();
        if ($request->filled('kategori_id')) $daerahQuery->where('kategori_id', $request->kategori_id);
        if ($request->filled('sektor_id'))   $daerahQuery->where('sektor_id', $request->sektor_id);
        if ($request->filled('nama'))        $daerahQuery->where('nama', 'like', '%'.$request->nama.'%');
        if ($request->filled('tahun') && $tahunDipilih !== 'all') $daerahQuery->whereYear('created_at', $tahunDipilih);
        if ($request->filled('bulan') && $bulanDipilih !== 'all') $daerahQuery->whereMonth('created_at', $bulanDipilih);

        $daerahCountsRaw = $daerahQuery->selectRaw('daerah_id, COUNT(*) as total')
            ->groupBy('daerah_id')->pluck('total','daerah_id');

        $daerahData = $daerahs->map(fn($d) => [
            'label' => $d->nama,
            'total' => $daerahCountsRaw[$d->id] ?? 0
        ]);
        $daerahLabels = $daerahData->pluck('label');
        $daerahCounts = $daerahData->pluck('total');

        $kategoriQuery = Umkm::query();
        if ($request->filled('daerah_id')) $kategoriQuery->where('daerah_id', $request->daerah_id);
        if ($request->filled('sektor_id')) $kategoriQuery->where('sektor_id', $request->sektor_id);
        if ($request->filled('nama'))      $kategoriQuery->where('nama', 'like', '%'.$request->nama.'%');
        if ($request->filled('tahun') && $tahunDipilih !== 'all') $kategoriQuery->whereYear('created_at', $tahunDipilih);
        if ($request->filled('bulan') && $bulanDipilih !== 'all') $kategoriQuery->whereMonth('created_at', $bulanDipilih);

        $kategoriCountsRaw = $kategoriQuery->selectRaw('kategori_id, COUNT(*) as total')
            ->groupBy('kategori_id')->pluck('total','kategori_id');

        $kategoriData = $kategoris->map(fn($k) => [
            'label' => $k->nama,
            'total' => $kategoriCountsRaw[$k->id] ?? 0
        ]);
        $kategoriLabels = $kategoriData->pluck('label');
        $kategoriCounts = $kategoriData->pluck('total');

        $sektorQuery = Umkm::query();
        if ($request->filled('kategori_id')) $sektorQuery->where('kategori_id', $request->kategori_id);
        if ($request->filled('daerah_id'))   $sektorQuery->where('daerah_id', $request->daerah_id);
        if ($request->filled('nama'))        $sektorQuery->where('nama', 'like', '%'.$request->nama.'%');
        if ($request->filled('tahun') && $tahunDipilih !== 'all') $sektorQuery->whereYear('created_at', $tahunDipilih);
        if ($request->filled('bulan') && $bulanDipilih !== 'all') $sektorQuery->whereMonth('created_at', $bulanDipilih);

        $sektorCountsRaw = $sektorQuery->selectRaw('sektor_id, COUNT(*) as total')
            ->groupBy('sektor_id')->pluck('total','sektor_id');

        $sektorData = $sektors->map(fn($s) => [
            'label' => $s->nama,
            'total' => $sektorCountsRaw[$s->id] ?? 0
        ]);
        $sektorLabels = $sektorData->pluck('label');
        $sektorCounts = $sektorData->pluck('total');

        // ---------------------------
        // Ambil daftar tahun
        // ---------------------------
        $daftarTahun = Umkm::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'asc')
            ->pluck('tahun');

        // ---------------------------
        // Return View
        // ---------------------------
        return view('noauth.umkm.index', compact(
            'umkms',
            'totalUmkm',
            'totalKaryawan',
            'tahunDipilih',
            'bulanDipilih',
            'statistikBulanan',
            'statistikTahunan',
            'daftarTahun',
            'tahunSekarang',
            'daerahLabels',
            'daerahCounts',
            'sektorLabels',
            'sektorCounts',
            'kategoriLabels',
            'kategoriCounts',
            'kategoris',
            'daerahs',
            'sektors',
            'karyawanBulanan',
            'karyawanTahunan',
            'kategoriBulanan',
            'kategoriTahunan',
            'daerahBulanan',
            'daerahTahunan',
            'sektorBulanan',
            'sektorTahunan',
        ));
    }
}
