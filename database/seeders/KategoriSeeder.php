<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Mikro', 'deskripsi' => '1 - 4 karyawan, omset < 300 juta'],
            ['nama' => 'Kecil', 'deskripsi' => '5 - 19 karyawan, omset 300 juta - 2,5 miliar'],
            ['nama' => 'Menengah', 'deskripsi' => '20 - 99 karyawan, omset 2,5 - 50 miliar'],
        ];

        foreach ($data as $item) {
            Kategori::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
