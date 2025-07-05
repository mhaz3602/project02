<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check jika ada relasi
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data lama
        DB::table('mahasiswa')->truncate();

        // Masukkan data baru
        DB::table('mahasiswa')->insert([
            [
                'nama' => 'Uci Ananda',
                'NIM' => '20211001',
                'jurusan' => 'Sistem Informasi',
                'email' => 'uci.ananda@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andi Saputra',
                'NIM' => '20211002',
                'jurusan' => 'Informatika',
                'email' => 'andi.saputra@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rina Lestari',
                'NIM' => '20211003',
                'jurusan' => 'Teknik Komputer',
                'email' => 'rina.lestari@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi Hartono',
                'NIM' => '20211004',
                'jurusan' => 'Sistem Informasi',
                'email' => 'budi.hartono@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sari Amelia',
                'NIM' => '20211005',
                'jurusan' => 'Manajemen Informatika',
                'email' => 'sari.amelia@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
