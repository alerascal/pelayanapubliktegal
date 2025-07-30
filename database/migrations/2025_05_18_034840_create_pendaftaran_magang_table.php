<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_magang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('lowongan_id');
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('asal_sekolah')->nullable(); // ditambahkan
            $table->string('cv')->nullable(); // tetap nullable
            $table->string('surat_izin')->nullable();
            $table->string('status')->default('menunggu');
            $table->year('tahun')->nullable(); // ditambahkan
            $table->date('tanggal_batas_kedatangan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lowongan_id')->references('id')->on('lowongan_magang')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_magang');
    }
};
