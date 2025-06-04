<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('lokasi_lahan')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('petani'); // Pastikan hanya ada 1 kolom role
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
// Pastikan untuk menjalankan migrasi ini dengan perintah:
// php artisan migrate
// Jika ingin menghapus tabel ini, gunakan:
// php artisan migrate:rollback
// Atau jika ingin menghapus semua migrasi, gunakan:
// php artisan migrate:reset
// Atau jika ingin menghapus semua migrasi dan menjalankan ulang, gunakan:
// php artisan migrate:fresh
