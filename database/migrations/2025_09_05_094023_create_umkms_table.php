<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('pemilik')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable(); // ✅ enum gender
            $table->enum('usia', ['<20', '20-29', '30-39', '40-49', '>50'])->nullable(); // ✅ enum usia
            $table->enum('pendidikan_terakhir', ['SD/SMP', 'SMA/SMK', 'Diploma', 'S1', 'S2/S3'])->nullable(); // ✅ enum pendidikan
            $table->year('tahun_berdiri')->nullable(); // ✅ tahun berdiri
            $table->enum('status_lokasi', ['Milik', 'Sewa'])->nullable(); // ✅ enum status lokasi
            $table->enum('sumber_modal', [
                'modal pribadi',
                'pinjaman keluarga',
                'bank',
                'koperasi/leasing',
                'program pemerintah/lainnya'
            ])->nullable(); // ✅ enum sumber modal
            $table->enum('metode_pemasaran', ['offline', 'online', 'offline&online'])->nullable(); // ✅ enum metode pemasaran
            $table->text('hambatan_pemasaran')->nullable(); // ✅ hambatan pemasaran
            $table->text('kebutuhan_pengembangan')->nullable(); // ✅ kebutuhan pengembangan

            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable(); // ✅ nomor telepon
            $table->unsignedInteger('jumlah_karyawan')->nullable(); // ✅ jumlah karyawan

            // Relasi
            $table->foreignId('kategori_id')->constrained('kategoris')->cascadeOnDelete();
            $table->foreignId('daerah_id')->constrained('daerahs')->cascadeOnDelete();
            $table->foreignId('sektor_id')->constrained('sektors')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
