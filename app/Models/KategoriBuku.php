<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategoribuku';
    protected $primaryKey = 'KategoriID';

    protected $fillable = [
        'NamaKategori',
    ];

    // Relasi dengan tabel kategoribuku_relasi
    public function kategoribuku_relasis()
    {
        return $this->hasMany(KategoribukuRelasi::class, 'KategoriID');
    }
}

