<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            // Ubah id_mahasiswa jadi nullable
            $table->unsignedBigInteger('id_mahasiswa')->nullable()->change();

            // Tambah user_id
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Kembalikan id_mahasiswa jadi required
            $table->unsignedBigInteger('id_mahasiswa')->nullable(false)->change();
        });
    }
};
