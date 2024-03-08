<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    use HasFactory;

    protected $table = 'ulasanbuku';
    protected $primaryKey = 'UlasanID';

    protected $fillable = [
        'UserID',
        'BukuID',
        'Ulasan',
        'Rating',
    ];

    // Definisi relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    // Definisi relasi dengan tabel Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
