<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sektor;

class SektorSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Pertanian', 'deskripsi' => 'Produk pertanian, perkebunan, dan peternakan'],
            ['nama' => 'Perdagangan', 'deskripsi' => 'Bidang jual beli dan distribusi barang'],
            ['nama' => 'Jasa', 'deskripsi' => 'Bidang layanan jasa dan konsultasi'],
            ['nama' => 'Industri Kreatif', 'deskripsi' => 'Bidang seni, media, dan kreativitas'],
        ];

        foreach ($data as $item) {
            Sektor::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
