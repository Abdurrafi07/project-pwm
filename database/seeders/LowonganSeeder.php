<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lowongans')->insert([
            [
                'judul' => 'Software Engineer',
                'deskripsi' => 'Bertanggung jawab mengembangkan aplikasi web dan mobile.',
                'lokasi' => 'Yogyakarta',
                'perusahaan' => 'PT Teknologi Nusantara',
                'no_hp' => '081234567890',
                'gambar' => 'lowongan/software-engineer.png',
                'tanggal_mulai' => Carbon::now(),
                'tanggal_akhir' => Carbon::now()->addDays(30),
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'Marketing Specialist',
                'deskripsi' => 'Membuat strategi pemasaran dan meningkatkan brand awareness.',
                'lokasi' => 'Jakarta',
                'perusahaan' => 'CV Kreatif Mandiri',
                'no_hp' => '089876543210',
                'gambar' => 'lowongan/marketing.png',
                'tanggal_mulai' => Carbon::now(),
                'tanggal_akhir' => Carbon::now()->addDays(15),
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'judul' => 'UI/UX Designer',
                'deskripsi' => 'Merancang antarmuka aplikasi yang menarik dan mudah digunakan.',
                'lokasi' => 'Bandung',
                'perusahaan' => 'Startup Digital Kreatif',
                'no_hp' => '082112223334',
                'gambar' => 'lowongan/uiux.png',
                'tanggal_mulai' => Carbon::now()->subDays(2),
                'tanggal_akhir' => Carbon::now()->addDays(10),
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
