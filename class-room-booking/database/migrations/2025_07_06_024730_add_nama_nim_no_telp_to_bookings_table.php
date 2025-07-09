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
        Schema::table('booking', function (Blueprint $table) {
            if (!Schema::hasColumn('booking', 'nama')) {
                $table->string('nama')->after('id_mahasiswa');
            }
            if (!Schema::hasColumn('booking', 'nim')) {
                $table->string('nim')->after('nama');
            }
            if (!Schema::hasColumn('booking', 'no_telp')) {
                $table->string('no_telp')->after('nim');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            if (Schema::hasColumn('booking', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('booking', 'nim')) {
                $table->dropColumn('nim');
            }
            if (Schema::hasColumn('booking', 'no_telp')) {
                $table->dropColumn('no_telp');
            }
        });
    }
};
