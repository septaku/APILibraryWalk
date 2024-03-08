<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiPribadi extends Model
{
    use HasFactory;

    protected $table = 'koleksipribadi';
    protected $primaryKey = 'KoleksiID';

    protected $fillable = [
        'UserID',
        'BukuID',
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
