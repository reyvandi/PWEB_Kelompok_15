<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan_nama'); // Kolom id, auto increment
            $table->string('kecamatan_nama'); // Nama lokasi
            $table->string('Kota_nama'); // Deskripsi lokasi, bisa kosong
            $table->string('Provinsi_nama'); // Nama lokasi
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
