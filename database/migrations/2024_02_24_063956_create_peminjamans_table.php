<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('PeminjamanID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('BukuID');
            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian');
            $table->enum('StatusPeminjaman', ['Belum Di Ambil', 'Dipinjam', 'Sudah Dikembalikan'])->default('Belum Di Ambil');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('BukuID')->references('BukuID')->on('buku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
}