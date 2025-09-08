<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daerah;

class DaerahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Yogyakarta', 'deskripsi' => 'Kota Yogyakarta dan sekitarnya'],
            ['nama' => 'Sleman', 'deskripsi' => 'Kabupaten Sleman'],
            ['nama' => 'Bantul', 'deskripsi' => 'Kabupaten Bantul'],
            ['nama' => 'Gunungkidul', 'deskripsi' => 'Kabupaten Gunungkidul'],
            ['nama' => 'Kulon Progo', 'deskripsi' => 'Kabupaten Kulon Progo'],
        ];

        foreach ($data as $item) {
            Daerah::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
