<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;
use App\Models\Kategori;
use App\Models\Daerah;
use App\Models\Sektor;
use Faker\Factory as Faker;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriIds = Kategori::pluck('id')->toArray();
        $daerahIds   = Daerah::pluck('id')->toArray();
        $sektorIds   = Sektor::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            Umkm::create([
                'nama'            => $faker->company,
                'pemilik'         => $faker->name,
                'alamat'          => $faker->address,
                'no_telp'         => $faker->phoneNumber,
                'jumlah_karyawan' => $faker->numberBetween(1, 200),
                'kategori_id'     => $faker->randomElement($kategoriIds),
                'daerah_id'       => $faker->randomElement($daerahIds),
                'sektor_id'       => $faker->randomElement($sektorIds),
            ]);
        }
    }
}
