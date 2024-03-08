<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoribukuTable extends Migration
{
    public function up(): void
    {
        Schema::create('kategoribuku', function (Blueprint $table) {
            $table->id('KategoriID');
            $table->string('NamaKategori', 225);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoribuku');
    }
}
