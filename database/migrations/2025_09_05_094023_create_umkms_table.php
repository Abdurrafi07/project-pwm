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
            $table->string('nama');
            $table->string('pemilik')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable(); // ✅ nomor telepon
            $table->unsignedInteger('jumlah_karyawan')->nullable(); // ✅ jumlah karyawan
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
