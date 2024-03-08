<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoleksipribadiTable extends Migration
{
    public function up(): void
    {
        Schema::create('koleksipribadi', function (Blueprint $table) {
            $table->id('KoleksiID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('BukuID');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('BukuID')->references('BukuID')->on('buku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koleksipribadi');
    }
}
