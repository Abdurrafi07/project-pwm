<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'perusahaan',
        'no_hp',
        'gambar',
        'tanggal_mulai',
        'tanggal_akhir',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_akhir' => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function isExpired()
    {
        return $this->tanggal_akhir < now();
    }
}

