<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function umkms()
    {
        return $this->hasMany(Umkm::class);
    }
}
