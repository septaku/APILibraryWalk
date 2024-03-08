<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';

    protected $fillable = [
        'UserID',
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman'
    ];

    protected $attributes = [
        'StatusPeminjaman' => 'Belum Di Ambil', // Nilai default untuk StatusPeminjaman
    ];


    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    // Relasi dengan tabel buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
