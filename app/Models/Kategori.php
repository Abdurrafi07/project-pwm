<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    // Relasi ke UMKM
    public function umkms()
    {
        return $this->hasMany(Umkm::class);
    }
}