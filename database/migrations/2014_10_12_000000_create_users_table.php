<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('Username', 255);
            $table->string('Password', 255);
            $table->string('Email', 255);
            $table->string('NamaLengkap', 255);
            $table->text('Alamat');
            $table->string('profile_picture')->nullable();
            $table->enum('Role', ['Admin', 'Petugas', 'User'])->default('User');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

class AddProfilePictureToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('Alamat'); // Tambahkan kolom profile_picture setelah kolom Alamat
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture'); // Hapus kolom profile_picture jika migrasi di-rollback
        });
    }
}
