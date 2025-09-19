<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'pemilik',
        'jenis_kelamin',
        'usia',
        'pendidikan_terakhir',
        'tahun_berdiri',
        'status_lokasi',
        'sumber_modal',
        'metode_pemasaran',
        'hambatan_pemasaran',
        'kebutuhan_pengembangan',
        'alamat',
        'no_telp',            // ✅ nomor telepon
        'jumlah_karyawan',    // ✅ jumlah karyawan
        'kategori_id',
        'daerah_id',
        'sektor_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }
}
