<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lowongan;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Buat 20 lowongan dummy
        for ($i = 1; $i <= 20; $i++) {
            Lowongan::create([
                'judul'         => $faker->sentence(6),
                'deskripsi'     => $faker->paragraph(5),
                'perusahaan'    => $faker->company,
                'lokasi'        => $faker->city,
                'no_hp'         => $faker->numerify('08##########'), // 10–13 digit
                'tanggal_mulai' => $faker->dateTimeBetween('-1 month', 'now'),
                'tanggal_akhir'=> $faker->dateTimeBetween('now', '+1 month'),
                'gambar'        => 'lowongan/' . Str::random(10) . '.jpg', // dummy path
            ]);
        }
    }
}
