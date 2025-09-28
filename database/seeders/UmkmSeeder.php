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

        // daftar pilihan enum
        $jenisKelamin       = ['laki-laki', 'perempuan'];
        $usia               = ['<20', '20-29', '30-39', '40-49', '>50'];
        $pendidikan         = ['SD/SMP', 'SMA/SMK', 'Diploma', 'S1', 'S2/S3'];
        $statusLokasi       = ['Milik', 'Sewa'];
        $sumberModal        = ['modal pribadi', 'pinjaman keluarga', 'bank', 'koperasi/leasing', 'program pemerintah/lainnya'];
        $metodePemasaran    = ['offline', 'online', 'offline&online'];

        for ($i = 1; $i <= 100; $i++) {
            Umkm::create([
                'nama'                  => $faker->company,
                'pemilik'               => $faker->name,
                'jenis_kelamin'         => $faker->randomElement($jenisKelamin),
                'usia'                  => $faker->randomElement($usia),
                'pendidikan_terakhir'   => $faker->randomElement($pendidikan),
                'tahun_berdiri'         => $faker->numberBetween(2024, 2027), // ✅ dibatasi 2024 - 2027
                'status_lokasi'         => $faker->randomElement($statusLokasi),
                'sumber_modal'          => $faker->randomElement($sumberModal),
                'metode_pemasaran'      => $faker->randomElement($metodePemasaran),
                'hambatan_pemasaran'    => $faker->sentence(10),
                'kebutuhan_pengembangan'=> $faker->sentence(12),

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
