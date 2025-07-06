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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();

            // Data Mahasiswa Manual
            $table->string('nama');
            $table->string('nim');
            $table->string('no_telp');

            // Foreign key ke tabel mahasiswa dan ruangan
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_ruangan')->constrained('ruangan')->onDelete('cascade');

            // Detail Booking
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('keperluan', 100);

            // Status Booking
            $table->enum('status', ['disetujui', 'dibatalkan', 'selesai', 'pending'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
