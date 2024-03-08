<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'BukuID';

    protected $fillable = [
        'Judul',
        'Penulis',
        'Penerbit',
        'TahunTerbit',
        'cover_photo',
    ];

    // Relasi dengan tabel kategoribuku_relasi
    public function kategoribuku_relasis()
    {
        return $this->hasMany(KategoribukuRelasi::class, 'BukuID');
    }

    // Relasi dengan tabel ulasanbuku
    public function ulasanbukus()
    {
        return $this->hasMany(Ulasanbuku::class, 'BukuID');
    }

    // Relasi dengan tabel koleksipribadi
    public function koleksipribadis()
    {
        return $this->hasMany(Koleksipribadi::class, 'BukuID');
    }

    // Relasi dengan tabel peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID');
    }
}
